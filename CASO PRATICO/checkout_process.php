<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'conexao.php';

// 1. Verificação de Segurança
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Erro: Acesso inválido. Por favor, utiliza o formulário de checkout.");
}

$ticket_id = $_POST['ticket_id'] ?? null;
if (!$ticket_id) { die("Erro: ID do bilhete não recebido."); }

$customer_id = null;

// 2. Lógica do Cliente
// A GRANDE MUDANÇA: Agora procura por $_SESSION['id'] igual ao resto do teu site!
if (isset($_SESSION['id'])) {
    
    // --- CASO 1: UTILIZADOR LOGADO ---
    $user_id = $_SESSION['id'];
    $res = $conn->query("SELECT id FROM customers WHERE user_id = " . (int)$user_id);
    
    if($res && $res->num_rows > 0) {
        $customer_id = $res->fetch_assoc()['id'];
    } else {
        $u_res = $conn->query("SELECT username, email FROM users WHERE id = " . (int)$user_id);
        if ($u_res && $u = $u_res->fetch_assoc()) {
            $stmt = $conn->prepare("INSERT INTO customers (name, email, user_id) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $u['username'], $u['email'], $user_id);
            $stmt->execute();
            $customer_id = $conn->insert_id;
        }
    }

} else {
    
    // --- CASO 2: CONVIDADO ---
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $phone = $_POST['phone'] ?? null;

    if (empty($name) || empty($email)) {
        die("Erro: Nome e Email são obrigatórios para convidados.");
    }
    
    $stmt = $conn->prepare("INSERT INTO customers (name, email, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $phone);
    $stmt->execute();
    $customer_id = $conn->insert_id;
    
}

// 3. Finalizar Venda
if ($customer_id) {
    $conn->begin_transaction();
    try {
        $conn->query("UPDATE tickets SET status = 'Sold' WHERE id = " . (int)$ticket_id);
        $stmt_sale = $conn->prepare("INSERT INTO sales (ticket_id, customer_id, sale_date) VALUES (?, ?, NOW())");
        $stmt_sale->bind_param("ii", $ticket_id, $customer_id);
        $stmt_sale->execute();
        
        $conn->commit();
        header("location: sucesso.php");
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        echo "Erro ao finalizar compra: " . $e->getMessage();
    }
} else {
    die("Erro: Falha ao identificar o cliente.");
}
?>