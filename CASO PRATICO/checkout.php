<?php
session_start();

// 1. Verificar se o utilizador está logado. Se não estiver, vai para o login!
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// 2. Verificar se o carrinho existe e tem produtos. Se estiver vazio, volta à loja.
if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
    header("Location: loja.php");
    exit;
}

include 'conexao.php';

$mensagem = "";

// 3. Inserir a encomenda na tabela 'orders'
$user_id = $_SESSION["id"];
$sql_order = "INSERT INTO orders (user_id) VALUES (?)";

if ($stmt = $conn->prepare($sql_order)) {
    $stmt->bind_param("i", $user_id);
    
    if ($stmt->execute()) {
        // Obter o ID da encomenda que o MySQL acabou de criar automaticamente
        $order_id = $conn->insert_id;
        
        // 4. Inserir cada produto do carrinho na tabela 'order_items'
        $sql_item = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
        
        if ($stmt_item = $conn->prepare($sql_item)) {
            foreach ($_SESSION['carrinho'] as $product_id => $produto) {
                $quantidade = $produto['quantidade'];
                
                $stmt_item->bind_param("iii", $order_id, $product_id, $quantidade);
                $stmt_item->execute();
            }
            $stmt_item->close();
        }
        
        // 5. A encomenda foi gravada! Vamos esvaziar o carrinho.
        unset($_SESSION['carrinho']);
        
        // Criar mensagem de sucesso
        $mensagem = "
        <div class='alert alert-success text-center py-5 shadow-sm' style='border-radius: 15px;'>
            <i class='fa-solid fa-circle-check mb-3' style='font-size: 4rem; color: #198754;'></i>
            <h2 style='font-family: var(--font-title); color: var(--roxo-escuro);'>Compra Realizada com Sucesso!</h2>
            <p class='fs-5 mt-3'>Obrigado por apoiares a Banda Kid Abelha.</p>
            <p class='fs-5'>A tua encomenda <strong>#000$order_id</strong> já está a ser processada pela nossa equipa.</p>
            <a href='loja.php' class='btn btn-warning fw-bold mt-4 px-4 py-2 fs-5'>Voltar à Loja</a>
        </div>";

    } else {
        $mensagem = "
        <div class='alert alert-danger text-center py-5 shadow-sm'>
            <i class='fa-solid fa-circle-exclamation mb-3' style='font-size: 4rem; color: #dc3545;'></i>
            <h2>Ups! Algo correu mal.</h2>
            <p class='fs-5'>Não foi possível processar a tua encomenda. Tenta novamente mais tarde.</p>
            <a href='carrinho.php' class='btn btn-danger fw-bold mt-3'>Voltar ao Carrinho</a>
        </div>";
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="pt">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra - Banda Kid Abelha</title>
    
    <link rel="shortcut icon" href="imagens/favicon.jpg" type="image/x-icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 

    <link rel="stylesheet" href="estilos/style.css" media="all">
    <link rel="stylesheet" href="estilos/media-query.css" media="all">
</head>

<body class="pagina-loja">
    
    <?php include 'header.php'; ?>

    <main class="py-5" style="min-height: 60vh; display: flex; align-items: center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <?php echo $mensagem; ?>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>