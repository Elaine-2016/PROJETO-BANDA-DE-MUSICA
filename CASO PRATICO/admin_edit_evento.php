<?php
session_start();
include 'conexao.php';

// Atualizar dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE events SET event_name=?, event_date=?, location=? WHERE id=?");
    $stmt->bind_param("sssi", $_POST['name'], $_POST['date'], $_POST['location'], $_POST['id']);
    $stmt->execute();
    header("location: admin.php?mensagem=sucesso"); // Redireciona para o painel principal
    exit; // Sempre importante usar exit após header
}

// Buscar dados atuais
$id = $_GET['id'];
$row = $conn->query("SELECT * FROM events WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <form method="POST" class="p-4 bg-white shadow rounded col-md-6 mx-auto">
            <h3>Editar Evento</h3>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label>Nome:</label>
            <input type="text" name="name" class="form-control mb-2" value="<?php echo $row['event_name']; ?>" required>
            <label>Data:</label>
            <input type="datetime-local" name="date" class="form-control mb-2" value="<?php echo date('Y-m-d\TH:i', strtotime($row['event_date'])); ?>" required>
            <label>Local:</label>
            <input type="text" name="location" class="form-control mb-2" value="<?php echo $row['location']; ?>" required>
            <button type="submit" class="btn btn-warning w-100">Atualizar</button>
        </form>
    </div>
</body>
</html>