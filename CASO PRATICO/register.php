<?php
include 'conexao.php';
$mensagem = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $mensagem = "<div class='alert alert-danger mt-3'><strong>Erro:</strong> As palavras-passe não coincidem.</div>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Lógica da Foto de Perfil (Agora com Avatar Padrão!)
        $profile_pic = "imagens/perfil/default-avatar.png"; 
        
        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
            $pasta_destino = "imagens/perfil/";
            $nome_ficheiro = time() . "_" . basename($_FILES['profile_pic']['name']);
            $caminho_completo = $pasta_destino . $nome_ficheiro;

            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $caminho_completo)) {
                $profile_pic = $caminho_completo;
            }
        }

        $sql = "INSERT INTO users (username, email, password, profile_pic) VALUES (?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $profile_pic);
            
            if ($stmt->execute()) {
                $mensagem = "<div class='alert alert-success mt-3'>Registo efetuado com sucesso! Já podes fazer <a href='login.php' class='alert-link'>login aqui</a>.</div>";
            } else {
                $mensagem = "<div class='alert alert-danger mt-3'>Erro ao registar. O nome ou email já existem.</div>";
            }
            $stmt->close();
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head> 
    <meta charset="UTF-8">
    <title>Registo - Banda Kid Abelha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
    <link rel="stylesheet" href="estilos/style.css" media="all">
</head>
<body class="pagina-loja bg-light"> 

    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-sm border-0 bg-white p-4">
                        <h2 class="text-center mb-4" style="color: #1D2C59;">Criar Nova Conta</h2>
                        
                        <?php echo $mensagem; ?>

                        <form action="register.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nome de Utilizador</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Foto de Perfil (Opcional)</label>
                                <input type="file" name="profile_pic" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Palavra-passe</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Confirmar Palavra-passe</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Telefone</label>
                                <input type="tel" name="phone" class="form-control" placeholder="912345678" required>
                            </div>

                            <button type="submit" class="btn btn-warning w-100 fw-bold fs-5">Registar Conta</button>
                            <a href="index.php" class="btn btn-outline-secondary w-100 mt-2 fw-bold"><i class="fa-solid fa-arrow-left"></i> Voltar ao Início</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>