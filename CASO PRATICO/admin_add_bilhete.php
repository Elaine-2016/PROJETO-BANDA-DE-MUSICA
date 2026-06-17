<?php
session_start();
// Verificação de segurança
if(!isset($_SESSION["role"]) || $_SESSION["role"] !== 'admin') { header("location: index.php"); exit; }
include 'conexao.php';

// --- LÓGICA DE PROCESSAMENTO (O que faltava) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO tickets (event_id, price, seat_number, status) VALUES (?, ?, ?, 'Available')");
    $stmt->bind_param("ids", $_POST['event_id'], $_POST['price'], $_POST['seat']);
    
    if ($stmt->execute()) {
        // Redireciona para o teu admin.php centralizado com sucesso
        header("location: admin.php?mensagem=sucesso");
        exit;
    }
}
// --- FIM DA LÓGICA ---
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Bilhete - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header bg-dark text-white">
                            <h4 class="mb-0">Adicionar Novo Bilhete</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <label class="form-label">Evento:</label>
                                <select name="event_id" class="form-select mb-3" required>
                                    <?php
                                    $res = $conn->query("SELECT id, event_name FROM events");
                                    while($row = $res->fetch_assoc()) echo "<option value='".$row['id']."'>".$row['event_name']."</option>";
                                    ?>
                                </select>
                                <label class="form-label">Preço (€):</label>
                                <input type="number" step="0.01" name="price" class="form-control mb-3" required>
                                <label class="form-label">Lugar (ex: A12):</label>
                                <input type="text" name="seat" class="form-control mb-3" required>
                                <button type="submit" class="btn btn-warning w-100 fw-bold">Guardar Bilhete</button>
                                <a href="admin.php" class="btn btn-outline-secondary w-100 mt-2">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>