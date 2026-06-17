<?php
session_start();
// Verificação de segurança
if(!isset($_SESSION["role"]) || $_SESSION["role"] !== 'admin') { header("location: index.php"); exit; }
include 'conexao.php';

$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Atualizámos o INSERT para incluir a descrição e a capacidade
    // ssssi = 4 strings (nome, data, local, desc) e 1 inteiro (capacidade)
    $stmt = $conn->prepare("INSERT INTO events (event_name, event_date, location, description, capacity) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $_POST['name'], $_POST['date'], $_POST['location'], $_POST['description'], $_POST['capacity']);
    
    if ($stmt->execute()) {
        header("location: admin.php?mensagem=sucesso");
        exit;
    } else {
        $mensagem = "<div class='alert alert-danger'>Erro ao adicionar evento: " . $stmt->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Evento - Admin</title>
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
                            <h4 class="mb-0">Adicionar Novo Evento</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $mensagem; ?>
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Nome do Evento:</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Data e Hora:</label>
                                    <input type="datetime-local" name="date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Local:</label>
                                    <input type="text" name="location" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Descrição:</label>
                                    <textarea name="description" class="form-control" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Capacidade (número de lugares):</label>
                                    <input type="number" name="capacity" class="form-control" min="1" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100 fw-bold">Guardar Evento</button>
                                <a href="admin.php" class="btn btn-outline-secondary w-100 mt-2">Voltar</a>
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