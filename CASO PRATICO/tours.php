<?php
session_start();
include 'conexao.php';

// Ir buscar os eventos da base de dados
$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Kid Abelha, shows, concertos, tour, agenda, Lisboa, Porto">
    <meta name="description" content="Confira as próximas datas de shows da Banda Kid Abelha.">
    <meta name="author" content="Elaine Gonçalves">
    <link rel="shortcut icon" href="imagens/favicon.jpg" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
    <link rel="stylesheet" href="estilos/style.css" media="all">
    <link rel="stylesheet" href="estilos/media-query.css" media="all">
    <title>Agenda de Concertos - Banda Kid Abelha</title>
</head>
<body>

    <?php include 'header.php'; ?>

    <main class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Próximos Concertos</h2>
            
            <div class="table-responsive">
                <table class="table table-striped text-center align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Evento / Concerto</th>
                            <th scope="col">Local</th>
                            <th scope="col">Bilhetes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . date('d/m/Y H:i', strtotime($row['event_date'])) . "</td>";
                                echo "<td>" . htmlspecialchars($row['event_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                                // Botão que leva à página de bilhetes desse evento específico
                                echo "<td><a href='tickets.php?event_id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Ver Bilhetes</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Não existem concertos agendados de momento.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    
    <?php include 'footer.php'; ?>  
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>