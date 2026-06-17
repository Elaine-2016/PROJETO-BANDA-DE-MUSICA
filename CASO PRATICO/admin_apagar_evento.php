<?php
session_start();
// Proteção: apenas administradores podem apagar
if(!isset($_SESSION["role"]) || $_SESSION["role"] !== 'admin'){
    header("location: index.php");
    exit;
}

include 'conexao.php';

// Verifica se o ID foi passado na URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Usamos prepared statement para ser seguro
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        header("location: admin.php?mensagem=sucesso");
    } else {
        header("location: admin.php?mensagem=erro");
    }
    $stmt->close();
}
?>