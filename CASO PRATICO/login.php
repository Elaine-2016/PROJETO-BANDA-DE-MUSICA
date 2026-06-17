<?php
// Iniciar a sessão
session_start();

// Verificar se o utilizador já está logado
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Incluir a conexão
include 'conexao.php';

$mensagem = "";

// Processar os dados quando o formulário é submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_input = trim($_POST['username']);
    $password_input = trim($_POST['password']);

    // Preparar a query
    $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username_input);
        
        if ($stmt->execute()) {
            $stmt->store_result();
            
            // Verificar se o utilizador existe
            if ($stmt->num_rows == 1) {
                
                // Inicializar variáveis para evitar o aviso do Intelephense
                $id = 0;
                $db_username = '';
                $hashed_password = '';
                $role = '';

                $stmt->bind_result($id, $db_username, $hashed_password, $role);
                
                if ($stmt->fetch()) {
                    // Verificar a palavra-passe
                    if (password_verify($password_input, $hashed_password)) {
                        
                        // Palavra-passe correta, iniciar sessão
                        session_start();
                        
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $db_username;
                        $_SESSION["role"] = $role;
                        
                        // Redirecionar para a página principal
                        header("location: index.php");
                        exit; // É boa prática usar exit após um header
                    } else {
                        $mensagem = "<div class='alert alert-danger' role='alert'>A palavra-passe que introduziste não está correta.</div>";
                    }
                }
            } else {
                $mensagem = "<div class='alert alert-danger' role='alert'>Não encontrámos nenhuma conta com esse nome de utilizador.</div>";
            }
        } else {
            $mensagem = "<div class='alert alert-warning' role='alert'>Ups! Algo correu mal. Tenta novamente mais tarde.</div>";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login na loja oficial da Banda Kid Abelha.">
    <title>Login - Banda Kid Abelha</title>
    
    <link rel="shortcut icon" href="imagens/favicon.jpg" type="image/x-icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 

    <link rel="stylesheet" href="estilos/style.css" media="all">
    <link rel="stylesheet" href="estilos/media-query.css" media="all">
</head>

<body class="pagina-loja">
    
    <header>
        <div class="container text-center py-3">
            <a href="index.php">
                <img src="imagens/logo.jpg" alt="Logotipo oficial da Banda Kid Abelha" class="img-fluid" style="max-height: 100px;">
            </a>
        </div>
    </header>

    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    
                    <div class="card shadow-sm border-0 bg-light p-4">
                        <h2 class="text-center mb-4" style="font-family: var(--font-title); color: var(--roxo-escuro);">Iniciar Sessão</h2>
                        
                        <?php echo $mensagem; ?>

                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label fw-bold">Nome de Utilizador</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="O teu nome de fã" required>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold">Palavra-passe</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="A tua palavra-passe secreta" required>
                            </div>

                            <button type="submit" class="btn btn-warning w-100 fw-bold fs-5">Entrar</button>

                            <a href="index.php" class="btn btn-outline-secondary w-100 mt-2 fw-bold"><i class="fa-solid fa-arrow-left"></i> Voltar ao Início</a>
                        </form>

                        <div class="text-center mt-4">
                            <p>Ainda não tens conta? <br><a href="register.php" class="text-decoration-none fw-bold" style="color: var(--laranja-queimado);">Regista-te aqui</a>.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-3 bg-dark text-white mt-5">
        <p class="p-footer mb-0">&copy; 2025 Banda Kid Abelha - Todos os direitos reservados.</p>
    </footer>

</body>
</html>