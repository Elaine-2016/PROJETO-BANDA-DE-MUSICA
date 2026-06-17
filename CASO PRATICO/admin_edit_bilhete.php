<?php
session_start();
if(!isset($_SESSION["role"]) || $_SESSION["role"] !== 'admin') { header("location: index.php"); exit; }
include 'conexao.php';

// Processar a atualização
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE tickets SET event_id=?, price=?, seat_number=?, status=? WHERE id=?");
    $stmt->bind_param("idsii", $_POST['event_id'], $_POST['price'], $_POST['seat'], $_POST['status'], $_POST['id']);
    if($stmt->execute()) {
        header("location: admin.php?mensagem=sucesso");
        exit;
    }
}

// Buscar dados atuais do bilhete
$id = $_GET['id'];
$bilhete = $conn->query("SELECT * FROM tickets WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Bilhete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container col-md-6 bg-white p-4 shadow rounded">
        <h3>Editar Bilhete</h3>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $bilhete['id']; ?>">
            
            <label>Evento:</label>
            <select name="event_id" class="form-control mb-2">
                <?php
                $res = $conn->query("SELECT id, event_name FROM events");
                while($row = $res->fetch_assoc()) {
                    $selected = ($row['id'] == $bilhete['event_id']) ? "selected" : "";
                    echo "<option value='{$row['id']}' $selected>{$row['event_name']}</option>";
                }
                ?>
            </select>
            
            <label>Preço:</label>
            <input type="number" step="0.01" name="price" class="form-control mb-2" value="<?php echo $bilhete['price']; ?>" required>
            
            <label>Lugar:</label>
            <input type="text" name="seat" class="form-control mb-2" value="<?php echo $bilhete['seat_number']; ?>" required>
            
            <label>Status:</label>
            <select name="status" class="form-control mb-3">
                <option value="Available" <?php echo ($bilhete['status'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                <option value="Sold" <?php echo ($bilhete['status'] == 'Sold') ? 'selected' : ''; ?>>Sold</option>
            </select>
            
            <button type="submit" class="btn btn-warning w-100">Guardar Alterações</button>
            <a href="admin.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
        </form>
    </div>
</body>
</html>