<?php
// Iniciar a sessão para podermos usar o carrinho
session_start();

// Incluir a conexão à base de dados
include 'conexao.php';

// Verificar se recebemos um pedido POST (alguém clicou em "Adicionar")
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Guardar os dados que vieram do formulário
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    // Validar se os dados estão corretos (maior que zero)
    if (isset($produto_id) && is_numeric($produto_id) && $quantidade > 0) {
        
        // Ir à base de dados buscar os detalhes deste produto específico
        $sql = "SELECT id, name, price, image FROM products WHERE id = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $produto_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Se o produto existir na base de dados
            if ($row = $result->fetch_assoc()) {
                
                // Se o carrinho ainda não existir nesta sessão, criamos um array vazio
                if (!isset($_SESSION['carrinho'])) {
                    $_SESSION['carrinho'] = array();
                }

                // Se o produto JÁ ESTIVER no carrinho, somamos apenas a nova quantidade
                if (isset($_SESSION['carrinho'][$produto_id])) {
                    $_SESSION['carrinho'][$produto_id]['quantidade'] += $quantidade;
                } else {
                    // Se NÃO ESTIVER no carrinho, adicionamos como um novo item
                    $_SESSION['carrinho'][$produto_id] = array(
                        'name' => $row['name'],
                        'price' => $row['price'],
                        'image' => $row['image'],
                        'quantidade' => $quantidade
                    );
                }
            }
            $stmt->close();
        }
    }
}

// Fechar a conexão
$conn->close();

// Redirecionar o utilizador de volta para a página da loja
header("Location: loja.php");
exit;
?>