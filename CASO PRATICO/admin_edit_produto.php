<?php
session_start();

// VERIFICAÇÃO DE SEGURANÇA: Só entram Admins!
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin'){
    header("location: index.php");
    exit;
}

include 'conexao.php';

$mensagem = "";

// 1. Ir buscar o ID do produto via URL (ex: admin_edit_produto.php?id=3)
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("location: admin.php");
    exit;
}
$id = (int)$_GET['id'];

// 2. Processar os dados quando o formulário é submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = str_replace(',', '.', trim($_POST['price']));
    $stock = (int)$_POST['stock'];
    
    // Lógica para verificar se foi enviada uma nova imagem
    $nova_imagem = "";
    if (isset($_FILES['imagem_upload']) && $_FILES['imagem_upload']['error'] == 0) {
        $pasta_destino = "imagens/";
        $nome_ficheiro = time() . "_" . basename($_FILES['imagem_upload']['name']);
        $caminho_completo = $pasta_destino . $nome_ficheiro;

        if (move_uploaded_file($_FILES['imagem_upload']['tmp_name'], $caminho_completo)) {
            $nova_imagem = $caminho_completo;
        }
    }

    // Se houver uma nova imagem, atualizamos a imagem também. Se não, atualizamos só os textos.
    if (!empty($nova_imagem)) {
        $sql_update = "UPDATE products SET name=?, description=?, price=?, stock=?, image=? WHERE id=?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("ssdisi", $name, $description, $price, $stock, $nova_imagem, $id);
    } else {
        $sql_update = "UPDATE products SET name=?, description=?, price=?, stock=? WHERE id=?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("ssdii", $name, $description, $price, $stock, $id);
    }
    
    if ($stmt->execute()) {
        $mensagem = "<div class='alert alert-success fw-bold'><i class='fa-solid fa-circle-check'></i> Produto atualizado com sucesso! <a href='admin.php' class='alert-link'>Voltar ao Painel</a></div>";
    } else {
        $mensagem = "<div class='alert alert-danger'><i class='fa-solid fa-triangle-exclamation'></i> Erro ao atualizar o produto.</div>";
    }
    $stmt->close();
}

// 3. Ir buscar os dados atuais para preencher o formulário
$query = $conn->prepare("SELECT * FROM products WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$resultado = $query->get_result();

if ($resultado->num_rows === 0) {
    header("location: admin.php"); // Se o produto não existir, volta para o painel
    exit;
}
$produto = $resultado->fetch_assoc();
$query->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head> 
    <meta charset="UTF-8">
    <title>Editar Produto - Gestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
</head>
<body class="bg-light">
    
    <?php include 'header.php'; ?>

    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 style="color: #1D2C59;">Editar Produto</h2>
                        <a href="admin.php" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
                    </div>
                    
                    <div class="card shadow-sm border-0 p-4">
                        <?php echo $mensagem; ?>

                        <form action="admin_edit_produto.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nome do Produto</label>
                                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($produto['name']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Descrição</label>
                                <textarea name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($produto['description']); ?></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Preço (€)</label>
                                    <input type="text" name="price" class="form-control" value="<?php echo $produto['price']; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Stock</label>
                                    <input type="number" name="stock" class="form-control" value="<?php echo $produto['stock']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold d-block">Imagem do Produto (Opcional)</label>
                                <img src="<?php echo htmlspecialchars($produto['image']); ?>" alt="Imagem Atual" style="width: 80px; height: 80px; object-fit: contain; border: 1px solid #ddd; border-radius: 5px;" class="mb-2">
                                <div class="form-text mb-2">Se não quiseres alterar a imagem, deixa este campo vazio.</div>
                                <input type="file" name="imagem_upload" class="form-control" accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold"><i class="fa-solid fa-floppy-disk"></i> Guardar Alterações</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>