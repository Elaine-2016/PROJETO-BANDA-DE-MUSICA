<?php
session_start();
if(!isset($_SESSION["role"]) || $_SESSION["role"] !== 'admin') { header("location: index.php"); exit; }
include 'conexao.php';

if(isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM tickets WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    header("location: admin.php?mensagem=sucesso");
    exit;
}
?>