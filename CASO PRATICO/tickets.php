<?php
session_start();
include 'conexao.php';

// VERIFICAÇÃO: Se não existir um ID na URL, envia o utilizador de volta para a lista de eventos
if (!isset($_GET['event_id']) || empty($_GET['event_id'])) {
    header("Location: tours.php"); // Volta para a lista de concertos
    exit(); // Para o carregamento da página aqui
}

$event_id = $_GET['event_id'];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Bilhetes - Banda Kid Abelha</title>
    <link rel="shortcut icon" href="imagens/favicon.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php include 'header.php'; ?>
    <main class="py-5">
        <div class="container">
            <h3>Bilhetes Disponíveis</h3>
            <table class="table table-striped mt-4">
                <tr><th>Lugar</th><th>Preço</th><th>Ação</th></tr>
                <?php
                $sql = "SELECT * FROM tickets WHERE event_id = ? AND status = 'Available'";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $event_id);
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$row['seat_number']."</td>
                        <td>€".$row['price']."</td>
                        <td>
                            <a href='checkout_tickets.php?ticket_id=".$row['id']."' class='btn btn-success'>Comprar</a>
                        </td>
                    </tr>";
                }
                ?>
            </table>
        </div>
    </main>
</body>
</html>