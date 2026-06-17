<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Compra Realizada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body class="bg-light">

    <?php include 'header.php'; ?>

    <main class="py-5">
        <div class="container text-center">
            <div class="card shadow p-5 col-md-6 mx-auto">
                <i class="fa-solid fa-check-circle text-success fa-5x mb-4"></i>
                <h2>Compra Realizada com Sucesso!</h2>
                <p class="lead">Obrigado pela tua compra. O teu bilhete foi reservado.</p>
                
                <div class="mt-4">
                    <a href="index.php" class="btn btn-primary">Voltar à Página Inicial</a>
                    <a href="tickets.php" class="btn btn-outline-secondary">Ver os meus bilhetes</a>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>