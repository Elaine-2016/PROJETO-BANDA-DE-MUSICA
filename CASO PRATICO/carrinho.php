<?php
session_start();

// Lógica para esvaziar o carrinho se o utilizador clicar no botão "Limpar Carrinho"
if (isset($_GET['acao']) && $_GET['acao'] == 'limpar') {
    unset($_SESSION['carrinho']); // Apaga a variável da sessão
    header("Location: carrinho.php"); // Atualiza a página
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Carrinho de Compras - Loja Oficial da Banda Kid Abelha.">
    <title>O Teu Carrinho - Banda Kid Abelha</title>
    
    <link rel="shortcut icon" href="imagens/favicon.jpg" type="image/x-icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 

    <link rel="stylesheet" href="estilos/style.css" media="all">
    <link rel="stylesheet" href="estilos/media-query.css" media="all">
</head>

<body class="pagina-loja">
    
    <?php include 'header.php'; ?>

    <main class="py-5">
        <div class="container">
            <h2 class="mb-4 text-center" style="font-family: var(--font-title); color: var(--roxo-escuro); font-size: 3rem;">O Teu Carrinho</h2>

            <?php 
            // Verificar se o carrinho existe e tem pelo menos 1 produto
            if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0): 
            ?>
                
                <div class="table-responsive">
                    <table class="table table-bordered align-middle bg-white shadow-sm text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Produto</th>
                                <th>Preço Unitário</th>
                                <th>Quantidade</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0; // Começamos com o total a zero
                            
                            // Percorrer todos os produtos que estão guardados na sessão
                            foreach ($_SESSION['carrinho'] as $id => $produto):
                                // Calcular o subtotal deste produto (Preço x Quantidade)
                                $subtotal = $produto['price'] * $produto['quantidade'];
                                // Adicionar ao Total da encomenda
                                $total += $subtotal;
                            ?>
                                <tr>
                                    <td class="text-start">
                                        <img src="<?php echo htmlspecialchars($produto['image']); ?>" alt="Imagem do produto" style="width: 60px; height: 60px; object-fit: contain;" class="me-3">
                                        <strong style="color: var(--azul-noite);"><?php echo htmlspecialchars($produto['name']); ?></strong>
                                    </td>
                                    <td>€<?php echo number_format($produto['price'], 2, ',', '.'); ?></td>
                                    <td>
                                        <span class="badge bg-warning text-dark fs-6 px-3 py-2"><?php echo $produto['quantidade']; ?></span>
                                    </td>
                                    <td class="fw-bold" style="color: var(--laranja-queimado);">€<?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fs-5 fw-bold text-uppercase">Total a Pagar:</td>
                                <td class="fs-4 fw-bold text-success">€<?php echo number_format($total, 2, ',', '.'); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-3">
                    <a href="carrinho.php?acao=limpar" class="btn btn-outline-danger fw-bold"><i class="fa-solid fa-trash"></i> Esvaziar Carrinho</a>
                    
                    <div class="d-flex gap-2">
                        <a href="loja.php" class="btn btn-secondary fw-bold">Continuar a Comprar</a>
                        <a href="checkout.php" class="btn btn-success fw-bold px-4 fs-5"><i class="fa-solid fa-check"></i> Finalizar Compra</a>
                    </div>
                </div>

            <?php else: ?>
                <div class="alert alert-warning text-center fs-5 py-4" role="alert">
                    <i class="fa-solid fa-basket-shopping fa-2x mb-3 d-block"></i>
                    O teu carrinho de compras está vazio no momento.<br>
                    Explora a nossa loja para encontrares os melhores produtos da banda!
                </div>
                <div class="text-center mt-4">
                    <a href="loja.php" class="btn btn-warning btn-lg fw-bold px-5">Ir para a Loja</a>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>