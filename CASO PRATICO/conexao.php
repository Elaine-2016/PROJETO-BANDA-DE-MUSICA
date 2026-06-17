<?php
$host = 'localhost';
$dbname = 'projeto_banda'; // Confirma que é este o nome da base de dados que criaste
$username = 'root';
$password = ''; 

$conn = new mysqli($host, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("A conexão falhou: " . $conn->connect_error);
}

// Mensagem temporária para testar
//echo "Conexão à base de dados bem-sucedida!";
?>