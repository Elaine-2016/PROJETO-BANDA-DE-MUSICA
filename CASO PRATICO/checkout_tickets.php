<?php
session_start();
include 'conexao.php';

$ticket_id = $_GET['ticket_id'] ?? null;
if (!$ticket_id) { die("Erro: ID do bilhete em falta."); }

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // Utilizador logado: Usa o método de POST seguro
    echo "<form id='formProcess' action='checkout_process.php' method='POST'>
            <input type='hidden' name='ticket_id' value='".htmlspecialchars($ticket_id)."'>
          </form>
          <script>document.getElementById('formProcess').submit();</script>";
} else {
    // Convidado: Segue para o formulário manual
    header("location: checkout_guest.php?ticket_id=".htmlspecialchars($ticket_id));
}
exit;
?>