<?php
session_start();

// VERIFICAÇÃO DE SEGURANÇA: Só entram Admins!
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin'){
    header("location: index.php");
    exit;
}

include 'conexao.php';

$mensagem = "";

// Processar os dados quando o formulário é submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = str_replace(',', '.', trim($_POST['price']));
    $stock = (int)$_POST['stock'];

    // Lógica do Upload de Imagem
    $image = "";
    if (isset($_FILES['imagem_upload']) && $_FILES['imagem_upload']['error'] == 0) {
        $pasta_destino = "imagens/";
        // Criar nome único para evitar conflitos
        $nome_ficheiro = time() . "_" . basename($_FILES['imagem_upload']['name']);
        $caminho_completo = $pasta_destino . $nome_ficheiro;

        if (move_uploaded_file($_FILES['imagem_upload']['tmp_name'], $caminho_completo)) {
            $image = $caminho_completo;
        }
    }

    // Só inserimos se o upload da imagem tiver ocorrido
    if (!empty($image)) {
        $sql = "INSERT INTO products (name, description, price, stock, image) VALUES (?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssdis", $name, $description, $price, $stock, $image);
            
            if ($stmt->execute()) {
                $mensagem = "<div class='alert alert-success fw-bold'><i class='fa-solid fa-circle-check'></i> Produto adicionado com sucesso! <a href='admin.php' class='alert-link'>Voltar ao Painel</a></div>";
            } else {
                $mensagem = "<div class='alert alert-danger'><i class='fa-solid fa-triangle-exclamation'></i> Erro ao inserir na base de dados.</div>";
            }
            $stmt->close();
        }
    } else {
        $mensagem = "<div class='alert alert-danger'>Erro no upload da imagem. Verifica se a pasta 'imagens/' existe.</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt">
<head> 
    <meta charset="UTF-8">
    <title>Adicionar Produto - Gestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
</head>
<body class="bg-light">
    
    <?php include 'header.php'; ?>

    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow-sm border-0 p-4">
                        <h2 class="mb-4">Adicionar Novo Produto</h2>
                        <?php echo $mensagem; ?>

                        <form action="admin_add_produto.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nome do Produto</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Descrição</label>
                                <textarea name="description" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Preço (€)</label>
                                    <input type="text" name="price" class="form-control" placeholder="0.00" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Stock</label>
                                    <input type="number" name="stock" class="form-control" value="10" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Imagem do Produto</label>
                                <input type="file" name="imagem_upload" class="form-control" accept="image/*" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100 fw-bold">Guardar Produto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>