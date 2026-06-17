<?php
session_start();
// Segurança: apenas admins podem apagar
if(!isset($_SESSION["role"]) || $_SESSION["role"] !== 'admin') { 
    header("location: index.php"); 
    exit; 
}

include 'conexao.php';

// Verifica se o ID foi passado via URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepared statement para apagar o produto
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        header("location: admin.php?mensagem=sucesso");
    } else {
        header("location: admin.php?mensagem=erro");
    }
    $stmt->close();
    exit;
}
?>