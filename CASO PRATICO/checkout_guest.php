<?php
// checkout_guest.php
if (!isset($_GET['ticket_id'])) { header("location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Convidado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container col-md-5 bg-white p-4 shadow rounded">
        <h3>Finalizar Compra</h3>
        <p>Preenche os teus dados para concluir a compra:</p>
        
        <form action="checkout_process.php" method="POST">
            
            <input type="hidden" name="ticket_id" value="<?php echo htmlspecialchars($_GET['ticket_id']); ?>">
            
            <div class="mb-3">
                <label>Nome:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Telefone:</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Confirmar Compra</button>
        </form>
    </div>
</body>
</html>