<?php
// Obter a foto de perfil do utilizador (se estiver logado)
$foto_perfil_header = "imagens/perfil/default-avatar.png"; // Imagem padrão

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["id"])) {
    // Usamos require_once para garantir que não há conflito se a conexão já estiver aberta noutra página
    require_once 'conexao.php'; 
    $stmt_header = $conn->prepare("SELECT profile_pic FROM users WHERE id = ?");
    if ($stmt_header) {
        $stmt_header->bind_param("i", $_SESSION["id"]);
        $stmt_header->execute();
        $res_header = $stmt_header->get_result();
        if ($row_header = $res_header->fetch_assoc()) {
            if (!empty($row_header['profile_pic'])) {
                $foto_perfil_header = $row_header['profile_pic'];
            }
        }
        $stmt_header->close();
    }
}
?>

<header>
    <div class="container text-center py-3">
        <a href="index.php">
            <img src="imagens/logo.jpg" alt="Logotipo oficial da Banda Kid Abelha" class="img-fluid" style="max-height: 100px;">
        </a>
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: relative; z-index: 9999;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php" aria-label="Kid Abelha - Página inicial">&#128029; KID ABELHA</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sobre.php">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="albuns.php">Álbuns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tours.php">Tour</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="loja.php">Loja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactos.php">Contactos</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
                    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link dropdown-toggle text-warning fw-bold d-flex align-items-center" href="#" id="navbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo htmlspecialchars($foto_perfil_header); ?>" alt="Perfil" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; margin-right: 8px; border: 2px solid #F5B932;">
                                Olá, <?php echo htmlspecialchars($_SESSION["username"]); ?>!
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarUser">
                                <li><a class="dropdown-item" href="perfil.php"><i class="fa-solid fa-id-badge"></i> O Meu Perfil</a></li>
                                
                                <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == 'admin'): ?>
                                    <li><a class="dropdown-item" href="admin.php"><i class="fa-solid fa-gear"></i> Área de Gestão</a></li>
                                <?php endif; ?>
                                
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Terminar Sessão</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <?php if(basename($_SERVER['PHP_SELF']) == 'index.php'): ?>
                            <li class="nav-item ms-2 mt-2 mt-lg-0">
                                <a class="btn btn-sm px-3 py-2" style="border: 2px solid #F5B932; color: #F5B932; font-weight: bold; background-color: transparent;" href="login.php">Entrar</a>
                            </li>
                            <li class="nav-item ms-2 mt-2 mt-lg-0">
                                <a class="btn btn-sm px-3 py-2" style="background-color: #F5B932; color: #1D2C59; font-weight: bold;" href="register.php">Registar</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav> 
</header>