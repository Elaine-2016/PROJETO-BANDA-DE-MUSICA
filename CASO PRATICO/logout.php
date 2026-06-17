<?php
// Iniciar a sessão
session_start();

// Apagar todas as variáveis da sessão
$_SESSION = array();

// Destruir a sessão
session_destroy();

// Redirecionar de volta para a página inicial
header("location: index.php");
exit;
?>