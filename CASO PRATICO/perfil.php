<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include 'conexao.php';
$id_utilizador = $_SESSION["id"];
$mensagem = "";

// Se o formulário para mudar a foto for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['nova_foto'])) {
    
    // Verifica se não houve nenhum erro no upload (0 = sem erros)
    if ($_FILES['nova_foto']['error'] == 0) {
        $pasta_destino = "imagens/perfil/";
        $nome_ficheiro = time() . "_" . basename($_FILES['nova_foto']['name']);
        $caminho_completo = $pasta_destino . $nome_ficheiro;

        // Tenta mover o ficheiro para a pasta
        if (move_uploaded_file($_FILES['nova_foto']['tmp_name'], $caminho_completo)) {
            // Atualiza a base de dados
            $sql = "UPDATE users SET profile_pic = ? WHERE id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("si", $caminho_completo, $id_utilizador);
                if ($stmt->execute()) {
                    $mensagem = "<div class='alert alert-success fw-bold'><i class='fa-solid fa-circle-check'></i> Foto de perfil atualizada com sucesso!</div>";
                } else {
                    $mensagem = "<div class='alert alert-danger'>Erro na base de dados ao guardar a foto.</div>";
                }
                $stmt->close();
            }
        } else {
            $mensagem = "<div class='alert alert-danger'>Erro ao guardar o ficheiro na pasta 'imagens/perfil/'. Verifica se a pasta existe.</div>";
        }
    } else {
        // Mostra qual foi o erro exato do upload
        $erro_codigo = $_FILES['nova_foto']['error'];
        if($erro_codigo == 1 || $erro_codigo == 2) {
            $mensagem = "<div class='alert alert-danger'><i class='fa-solid fa-triangle-exclamation'></i> A imagem que escolheste é demasiado pesada (Tamanho máximo excedido). Tenta uma imagem mais leve.</div>";
        } else {
            $mensagem = "<div class='alert alert-danger'>Ocorreu um erro no upload da imagem. Código: $erro_codigo</div>";
        }
    }
}

// Ir buscar os dados atuais do utilizador (incluindo a foto)
$query = $conn->prepare("SELECT username, email, profile_pic FROM users WHERE id = ?");
$query->bind_param("i", $id_utilizador);
$query->execute();
$dados_user = $query->get_result()->fetch_assoc();

// Verificar se tem foto (mesmo depois do SQL que corremos)
$tem_foto = !empty($dados_user['profile_pic']);

$query->close();

?>

<!DOCTYPE html>
<html lang="pt">
    <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Site oficial da Banda Kid Abelha. Descubra a história do rock brasileiro com clássicos como Fixação e Como Eu Quero. Confira álbuns, agenda de shows e entre em contato.">
        <meta name="keywords" content="Kid Abelha, banda brasileira, rock nacional, Paula Toller, anos 80, música brasileira, Fixação, Como Eu Quero">
        <meta name="author" content="Elaine Gonçalves">
        <title>Meu Perfil - Banda Kid Abelha</title>

        <link rel="shortcut icon" href="imagens/favicon.jpg" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
        
        <link rel="stylesheet" href="estilos/style.css" media="all">
        <link rel="stylesheet" href="estilos/media-query.css" media="all">
        
    </head>

    <body class="bg-light">

        <?php include 'header.php'; ?>

        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 p-4 text-center">
                            <h2 style="color: #1D2C59;">O Meu Perfil</h2>
                            
                            <?php echo $mensagem; ?>

                            <div class="mt-4 mb-3">
                                <?php if($tem_foto): ?>
                                    <img src="<?php echo htmlspecialchars($dados_user['profile_pic']); ?>" alt="Foto de Perfil" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 3px solid #F5B932;">
                                <?php else: ?>
                                    <div style="width: 150px; height: 150px; border-radius: 50%; background-color: #ddd; display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 3px solid #F5B932;">
                                        <i class="fa-solid fa-user fa-4x text-secondary"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <h4 class="fw-bold"><?php echo htmlspecialchars($dados_user['username']); ?></h4>
                            <p class="text-muted"><?php echo htmlspecialchars($dados_user['email']); ?></p>

                            <hr>

                            <form action="perfil.php" method="POST" enctype="multipart/form-data" class="mt-4 text-start">
                                <label class="form-label fw-bold">Alterar Foto de Perfil</label>
                                <div class="input-group">
                                    <input type="file" name="nova_foto" class="form-control" accept="image/*" required>
                                    <button type="submit" class="btn btn-warning fw-bold">Atualizar Foto</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include 'footer.php'; ?>

    </body>
</html>