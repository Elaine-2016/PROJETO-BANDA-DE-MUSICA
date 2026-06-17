<?php
session_start();
include 'conexao.php';

// 1. Verificar se um filtro foi enviado via URL
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// 2. Montar a consulta SQL de forma segura
if ($categoria == 'Merchandise' || $categoria == 'Albuns') {
    $sql = "SELECT * FROM products WHERE category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $categoria);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="pt">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Oficial - Banda Kid Abelha</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="estilos/style.css" media="all">
</head>
<body class="pagina-loja">

    <?php include 'header.php'; ?>

    <main class="py-5">
        <div class="container">
            
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 style="font-family: var(--font-title); color: #F5B932; font-size: 3rem;">Loja Oficial</h2>
                
                <a href="carrinho.php" class="btn btn-dark fs-5 position-relative">
                    <i class="fa-solid fa-cart-shopping"></i> Ver Carrinho
                    <?php 
                    if(isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
                        echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">' . count($_SESSION['carrinho']) . '</span>';
                    }
                    ?>
                </a>
            </div>

            <section class="row mb-5 justify-content-center">
                <div class="col-md-4 text-center">
                    <label for="category-filter" class="form-label fw-bold">Filtrar por Categoria:</label>
                    <select id="category-filter" class="form-select border-warning" onchange="window.location.href='loja.php?categoria='+this.value">
                        <option value="" <?php if($categoria == '') echo 'selected'; ?>>Todas as Categorias</option>
                        <option value="Merchandise" <?php if($categoria == 'Merchandise') echo 'selected'; ?>>Merchandise</option>
                        <option value="Albuns" <?php if($categoria == 'Albuns') echo 'selected'; ?>>Albuns e CD's</option>
                    </select>
                </div>
            </section>

            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <img src="<?php echo htmlspecialchars($row["image"]); ?>" class="card-img-top p-3" alt="<?php echo htmlspecialchars($row["name"]); ?>" style="height: 250px; object-fit: contain;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold text-center"><?php echo htmlspecialchars($row["name"]); ?></h5>
                                    <p class="card-text text-muted small text-center"><?php echo htmlspecialchars($row["description"]); ?></p>
                                    <h4 class="text-center mt-auto fw-bold" style="color: #F5B932;">€<?php echo number_format($row["price"], 2, ',', '.'); ?></h4>
                                    
                                    <form action="adicionar_carrinho.php" method="POST" class="mt-3">
                                        <input type="hidden" name="produto_id" value="<?php echo $row["id"]; ?>">
                                        <div class="input-group">
                                            <input type="number" name="quantidade" class="form-control" value="1" min="1" max="<?php echo $row["stock"]; ?>" required>
                                            <button type="submit" class="btn btn-warning fw-bold"><i class="fa-solid fa-cart-plus"></i> Adicionar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-12"><p class="text-center alert alert-warning">Nenhum produto encontrado nesta categoria.</p></div>';
                }
                ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>