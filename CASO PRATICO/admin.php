<?php

session_start();

// VERIFICAÇÃO DE SEGURANÇA: Só entram Admins!
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin'){
    header("location: index.php");
    exit;
}

include 'conexao.php';

// Ir buscar estatísticas rápidas
$total_users = $conn->query("SELECT COUNT(id) AS total FROM users")->fetch_assoc()['total'];
$total_products = $conn->query("SELECT COUNT(id) AS total FROM products")->fetch_assoc()['total'];
$total_orders = $conn->query("SELECT COUNT(id) AS total FROM orders")->fetch_assoc()['total'];

// Ir buscar as listas para as tabelas
$lista_utilizadores = $conn->query("SELECT id, username, email, role FROM users ORDER BY id DESC");
$lista_produtos = $conn->query("SELECT id, name, price, stock, image FROM products ORDER BY id DESC");
// Na lista de encomendas, juntamos a tabela users para saber o NOME de quem comprou, e não apenas o ID
$lista_encomendas = $conn->query("SELECT orders.id, users.username, orders.order_date, orders.status FROM orders JOIN users ON orders.user_id = users.id ORDER BY orders.order_date DESC");

// Adiciona isto junto das outras consultas no topo do admin.php
$lista_eventos = $conn->query("SELECT * FROM events ORDER BY event_date ASC");
$lista_bilhetes = $conn->query("SELECT tickets.*, events.event_name FROM tickets JOIN events ON tickets.event_id = events.id");

// Estatísticas de Concertos
$total_eventos = $conn->query("SELECT COUNT(id) AS total FROM events")->fetch_assoc()['total'];
$total_vendidos = $conn->query("SELECT COUNT(id) AS total FROM tickets WHERE status = 'Sold'")->fetch_assoc()['total'];
$total_disponiveis = $conn->query("SELECT COUNT(id) AS total FROM tickets WHERE status = 'Available'")->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html lang="pt">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Gestão - Banda Kid Abelha</title>
    
    <link rel="shortcut icon" href="imagens/favicon.jpg" type="image/x-icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 

    <link rel="stylesheet" href="estilos/style.css" media="all">
    <link rel="stylesheet" href="estilos/media-query.css" media="all">
</head>

<body class="bg-light">
    
    <?php include 'header.php'; ?>

    <main class="py-5">
        <div class="container">
            <h2 class="mb-4" style="font-family: var(--font-title); color: var(--roxo-escuro);">Área de Gestão a Vista</h2>
            
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-primary shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa-solid fa-users fa-3x me-3"></i>
                            <div>
                                <h5 class="card-title mb-0" style="color: #1D2C59;">Utilizadores Registados</h5>
                                <h2 class="mb-0 fw-bold" style="color: #1D2C59;"><?php echo $total_users; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-success shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa-solid fa-box-open fa-3x me-3"></i>
                            <div>
                                <h5 class="card-title mb-0" style="color: #1D2C59;">Produtos na Loja</h5>
                                <h2 class="mb-0 fw-bold" style="color: #1D2C59;"><?php echo $total_products; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-warning shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa-solid fa-cart-arrow-down fa-3x me-3 text-dark"></i>
                            <div class="text-dark">
                                <h5 class="card-title mb-0" style="color: #1D2C59;">Encomendas Realizadas</h5>
                                <h2 class="mb-0 fw-bold" style="color: #1D2C59;"><?php echo $total_orders; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-primary shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa-solid fa-users fa-3x me-3"></i>
                            <div>
                                <h5 class="card-title mb-0" style="color: #1D2C59;">Total Eventos</h5>
                                <h2 class="mb-0 fw-bold" style="color: #1D2C59;"><?php echo $total_eventos; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-success shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa-solid fa-ticket fa-3x me-3"></i>
                            <div>
                                <h5 class="card-title mb-0"style="color: #1D2C59;" >Bilhetes Vendidos</h5>
                                <h2 class="mb-0 fw-bold" style="color: #1D2C59;"><?php echo $total_vendidos; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-warning shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center">
                            <i class="fa-solid fa-chair fa-3x me-3 text-dark"></i>
                            <div class="text-dark">
                                <h5 class="card-title mb-0" style="color: #1D2C59;">Bilhetes Disponíveis</h5>
                                <h2 class="mb-0 fw-bold" style="color: #1D2C59;"><?php echo $total_disponiveis; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs" id="adminTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold" id="encomendas-tab" data-bs-toggle="tab" data-bs-target="#encomendas" type="button" role="tab"><i class="fa-solid fa-box"></i> Encomendas</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold" id="produtos-tab" data-bs-toggle="tab" data-bs-target="#produtos" type="button" role="tab"><i class="fa-solid fa-tags"></i> Produtos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold" id="utilizadores-tab" data-bs-toggle="tab" data-bs-target="#utilizadores" type="button" role="tab"><i class="fa-solid fa-users-gear"></i> Utilizadores</button>
                </li>
            </ul>

            <div class="tab-content bg-white p-4 border border-top-0 shadow-sm" id="adminTabsContent">
                
                <div class="tab-pane fade show active" id="encomendas" role="tabpanel">
                    <h4 class="mb-3" style="color: var(--roxo-escuro);">Lista de Encomendas</h4>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID Encomenda</th>
                                    <th>Cliente</th>
                                    <th>Data e Hora</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($enc = $lista_encomendas->fetch_assoc()): ?>
                                <tr>
                                    <td class="fw-bold">#000<?php echo $enc['id']; ?></td>
                                    <td><?php echo htmlspecialchars($enc['username']); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($enc['order_date'])); ?></td>
                                    <td>
                                        <?php if($enc['status'] == 'pending'): ?>
                                            <span class="badge bg-warning text-dark">Pendente</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Concluída</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="produtos" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0" style="color: var(--roxo-escuro);">Inventário de Produtos</h4>
                        <a href="admin_add_produto.php" class="btn btn-success fw-bold"><i class="fa-solid fa-plus"></i> Adicionar Produto</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Imagem</th>
                                    <th>Nome do Produto</th>
                                    <th>Preço</th>
                                    <th>Stock</th>
                                    <th>Ações</th> </tr>
                            </thead>
                            <tbody>
                                <?php while($prod = $lista_produtos->fetch_assoc()): ?>
                                <tr>
                                    <td><img src="<?php echo htmlspecialchars($prod['image']); ?>" alt="img" style="width: 40px; height: 40px; object-fit: contain;"></td>
                                    <td class="text-start fw-bold"><?php echo htmlspecialchars($prod['name']); ?></td>
                                    <td>€<?php echo number_format($prod['price'], 2, ',', '.'); ?></td>
                                    <td>
                                        <?php if($prod['stock'] > 5): ?>
                                            <span class="badge bg-success"><?php echo $prod['stock']; ?> un.</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger"><?php echo $prod['stock']; ?> un. (Pouco)</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="admin_edit_produto.php?id=<?php echo $prod['id']; ?>" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                        </a>
                                        
                                        <a href="admin_apagar_produto.php?id=<?php echo $prod['id']; ?>" 
                                        class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Tem a certeza que deseja apagar este produto? Esta ação não pode ser desfeita.');">
                                        <i class="fa-solid fa-trash"></i> Apagar
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="utilizadores" role="tabpanel">
                    <h4 class="mb-3" style="color: var(--roxo-escuro);">Gestão de Contas</h4>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome de Utilizador</th>
                                    <th>Email</th>
                                    <th>Papel (Role)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($user = $lista_utilizadores->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td class="fw-bold"><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td>
                                        <?php if($user['role'] == 'admin'): ?>
                                            <span class="badge bg-danger"><i class="fa-solid fa-crown"></i> Admin</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><i class="fa-solid fa-user"></i> Fã</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="container mt-4 mb-5">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <ul class="nav nav-tabs card-header-tabs" id="eventTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-eventos" type="button">Eventos</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-bilhetes" type="button">Bilhetes</button>
                        </li>
                    </ul>
                </div>
                    <div class="card-body tab-content" id="eventTabContent">
                        <div class="tab-pane fade show active" id="tab-eventos">
                            <div class="d-flex justify-content-between mb-3">
                                <h5>Lista de Eventos</h5>
                                <a href="admin_add_evento.php" class="btn btn-success btn-sm">+ Novo Evento</a>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead><tr><th>Nome</th><th>Data</th><th>Local</th><th>Ações</th></tr></thead>
                                <tbody>
                                    <?php while($row = $lista_eventos->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['event_name']; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($row['event_date'])); ?></td>
                                        <td><?php echo $row['location']; ?></td>                                        
                                        <td>
                                            <a href='admin_edit_evento.php?id=<?php echo $row['id']; ?>' class='btn btn-warning btn-sm'>Editar</a>
                                            <a href='admin_apagar_evento.php?id=<?php echo $row['id']; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Apagar evento?');">Apagar</a>
                                        </td>                                        
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab-bilhetes">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Lista de Bilhetes</h5>
                            <a href="admin_add_bilhete.php" class="btn btn-success btn-sm">+ Novo Bilhete</a>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead><tr><th>Evento</th><th>Lugar</th><th>Preço</th><th>Status</th></tr></thead>
                            <tbody>
                                <?php while($row = $lista_bilhetes->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['event_name']; ?></td>
                                    <td><?php echo $row['seat_number']; ?></td>
                                    <td>€<?php echo $row['price']; ?></td>
                                    <td><span class="badge bg-info"><?php echo $row['status']; ?></span></td>
                                    <td>
                                        <a href='admin_edit_bilhete.php?id=<?php echo $row['id']; ?>' class='btn btn-warning btn-sm'>Editar</a>
                                        <a href='admin_apagar_bilhete.php?id=<?php echo $row['id']; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Apagar bilhete?');">Apagar</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
