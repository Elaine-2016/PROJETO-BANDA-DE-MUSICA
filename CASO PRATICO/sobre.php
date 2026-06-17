<?php
session_start();
include 'conexao.php';

// Ir buscar todos os produtos à base de dados
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
    <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="Kid Abelha, história da banda, Paula Toller, George Israel, Bruno Fortunato, rock brasileiro, anos 80">
        <meta name="description" content="Conheça a história completa da Banda Kid Abelha, seus integrantes icônicos Paula Toller, George Israel e Bruno Fortunato, e o legado de 30 anos de música brasileira.">
        <meta name="author" content="Elaine Gonçalves">
        <link rel="shortcut icon" href="imagens/favicon.jpg" type="image/x-icon">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 

        <link rel="stylesheet" href="estilos/style.css" media="all">
        <link rel="stylesheet" href="estilos/media-query.css" media="all">

        <title>Sobre a Banda Kid Abelha | História e Integrantes</title>
    </head>

    <body class="pagina-sobre">
        
        <?php include 'header.php'; ?>
        
        <main class="container-fluid py-5 main-sobre">
            <div class="container text-center">

                <h1>A Banda Kid Abelha</h1>
                
                <section>
                    <h2>História</h2>
                    <p><strong>Kid Abelha</strong> (também conhecida como Kid Abelha e os Abóboras Selvagens entre 1982 e 1988) foi uma das mais icônicas bandas brasileiras de pop rock, formada no início dos <a href="https://pt.wikipedia.org/wiki/Kid_Abelha" target="_blank" rel="noopener noreferrer">anos 80</a>.</p>
                    
                    <p>Paula Toller, George Israel e Bruno Fortunato comemoram trinta anos de carreira com lançamento de "Multishow Ao Vivo – Kid Abelha 30 Anos" (Posto 9 / Microservice) em DVD, CD e Blu-Ray. Gravado diante de 10 mil pessoas no dia 28 de abril de 2012, no Citibank Hall, no Rio de Janeiro. Uma das bandas da Era de Ouro da geração 80, única liderada por uma mulher e sinônimo de pop inteligente.</p>
                </section>

                <section>
                    <h2 class="mt-5">Galeria de Integrantes</h2>
                    <div class="row g-4 mt-3 justify-content-center">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <article class="card integrante-card text-center">
                                <img src="imagens/PAULATOLLER.jpg" class="card-img-top img-fluid" alt="Paula Toller, vocalista da banda Kid Abelha, conhecida por sua voz marcante no rock brasileiro" loading="lazy">
                                <div class="card-body">
                                    <h3 class="card-title">Paula Toller</h3>
                                    <p class="card-text">Vocal</p>
                                </div>
                            </article>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <article class="card integrante-card text-center">
                                <img src="imagens/George_Israel.jpg" class="card-img-top img-fluid" alt="George Israel, saxofonista e guitarrista da banda Kid Abelha" loading="lazy">
                                <div class="card-body">
                                    <h3 class="card-title">George Israel</h3>
                                    <p class="card-text">Saxofone, guitarra e vocais</p>
                                </div>
                            </article>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <article class="card integrante-card text-center">
                                <img src="imagens/Bruno-Fortunato.jpg" class="card-img-top img-fluid" alt="Bruno Fortunato, guitarrista fundador da banda Kid Abelha" loading="lazy">
                                <div class="card-body">
                                    <h3 class="card-title">Bruno Fortunato</h3>
                                    <p class="card-text">Guitarra</p>
                                </div>
                            </article>
                        </div>
                    </div>
                </section>

                <section class="mt-5">
                    <h2>Ex-Integrantes</h2>
                    <ul class="list-unstyled lista-integrantes text-center">
                        <li><strong>Pedro Farah</strong> – Guitarra</li>
                        <li><strong>Beni Borja</strong> – Produtor musical e Bateria</li>
                        <li><strong>Leoni</strong> – Baixo e Compositor</li>
                        <li><strong>Cláudio Infante</strong> – Bateria</li>
                    </ul>
                </section>

                <p class="mt-4">Com sucessos marcantes como <em>"Como Eu Quero"</em> e <em>"Fixação"</em>, a banda conquistou gerações de fãs.</p>

            </div>
        </main>

        <?php include 'footer.php'; ?>     
    </body>
</html>

<?php 
// Fechar a conexão
$conn->close(); 
?>