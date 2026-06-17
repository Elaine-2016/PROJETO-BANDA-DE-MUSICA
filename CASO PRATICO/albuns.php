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
        <meta name="keywords" content="Kid Abelha, discografia, álbuns, Seu Espião, Fixação, Como Eu Quero, rock brasileiro">
        <meta name="description" content="Explore a discografia completa da Banda Kid Abelha. Descubra todos os álbuns desde Seu Espião (1984) até Pega Vida (2005), incluindo clássicos como Fixação e Lágrimas e Chuva.">
        <meta name="author" content="Elaine Gonçalves">
        <link rel="shortcut icon" href="imagens/favicon.jpg" type="image/x-icon">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 

        <link rel="stylesheet" href="estilos/style.css" media="all">
        <link rel="stylesheet" href="estilos/media-query.css" media="all">

        <title>Discografia - Kid Abelha | Todos os Álbuns</title>
    </head>

    <body class="pagina-albuns">
        
        <?php include 'header.php'; ?>
        
        <main class="container-fluid py-5  main-sobre">
            <h1 class="text-center mb-5">Discografia Completa</h1>
            
            <div class="row g-4">
                <div class="col-12 col-sm-6 col-md-4">
                    <article class="card card-album">
                        <img src="imagens/espião.jpg" class="card-img-top" alt="Capa do álbum Seu Espião da banda Kid Abelha, lançado em 1984, com os clássicos Fixação e Como Eu Quero" loading="lazy">
                        <div class="card-body">
                            <h2 class="card-title">Seu Espião (1984)</h2>
                            <p class="card-text">Álbum de estreia com os clássicos "Fixação" e "Como Eu Quero".</p>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <article class="card card-album">
                        <img src="imagens/Educação-Sentimental.jpg" class="card-img-top" alt="Capa do álbum Educação Sentimental da Kid Abelha, lançado em 1985, incluindo o hit Lágrimas e Chuva" loading="lazy">
                        <div class="card-body">
                            <h2 class="card-title">Educação Sentimental (1985)</h2>
                            <p class="card-text">Inclui sucessos como "Lágrimas e Chuva".</p>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <article class="card card-album">
                        <img src="imagens/Tomate.jpg" class="card-img-top" alt="Capa do álbum Tomate da Kid Abelha de 1987, consolidando o sucesso da banda no rock brasileiro" loading="lazy">
                        <div class="card-body">
                            <h2 class="card-title">Tomate (1987)</h2>
                            <p class="card-text">Um disco que consolida o sucesso da banda no cenário do rock brasileiro.</p>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <article class="card card-album">
                        <img src="imagens/kid.jpg" class="card-img-top" alt="Capa do álbum Kid de 1989 com as músicas Dizer Não É Dizer Sim e Agora Sei" loading="lazy">
                        <div class="card-body">
                            <h2 class="card-title">Kid (1989)</h2>
                            <p class="card-text">Álbum com as músicas "Dizer Não É Dizer Sim" e "Agora Sei".</p>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <article class="card card-album">
                        <img src="imagens/Tudo-É-Permitido.jpg" class="card-img-top" alt="Capa do álbum Tudo É Permitido da Kid Abelha lançado em 1991" loading="lazy">
                        <div class="card-body">
                            <h2 class="card-title">Tudo É Permitido (1991)</h2>
                            <p class="card-text">Um trabalho que mostra a evolução musical da banda.</p>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <article class="card card-album">
                        <img src="imagens/Iê-Iê-Iê.jpg" class="card-img-top" alt="Capa do álbum Iê Iê Iê da Kid Abelha de 1993 com novas sonoridades" loading="lazy">
                        <div class="card-body">
                            <h2 class="card-title">Iê Iê Iê (1993)</h2>
                            <p class="card-text">Um álbum que trouxe novas sonoridades e mantém a banda no auge.</p>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <article class="card card-album">
                        <img src="imagens/Meu-Mundo-Gira-em-Torno-de-Você.jpg" class="card-img-top" alt="Capa do álbum Meu Mundo Gira em Torno de Você da Kid Abelha lançado em 1996" loading="lazy">
                        <div class="card-body">
                            <h2 class="card-title">Meu Mundo Gira em Torno de Você (1996)</h2>
                            <p class="card-text">Um álbum que aborda temas de amor de forma mais madura.</p>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <article class="card card-album">
                        <img src="imagens/autolove.jpg" class="card-img-top" alt="Capa do álbum Autolove da Kid Abelha de 1998 mostrando versatilidade musical" loading="lazy">
                        <div class="card-body">
                            <h2 class="card-title">Autolove (1998)</h2>
                            <p class="card-text">Continua com o sucesso dos álbuns anteriores, mostrando a versatilidade da banda.</p>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <article class="card card-album">
                        <img src="imagens/Surf.jpg" class="card-img-top" alt="Capa do álbum Surf da Kid Abelha lançado em 2001 com influências de diversos estilos" loading="lazy">
                        <div class="card-body">
                            <h2 class="card-title">Surf (2001)</h2>
                            <p class="card-text">Um disco mais leve e com influências de outros estilos.</p>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <article class="card card-album">
                        <img src="imagens/Pega-Vida.jpg" class="card-img-top" alt="Capa do álbum Pega Vida de 2005, última produção de estúdio da banda Kid Abelha" loading="lazy">
                        <div class="card-body">
                            <h2 class="card-title">Pega Vida (2005)</h2>
                            <p class="card-text">A última produção de estúdio da banda, que encerra essa trajetória.</p>
                        </div>
                    </article>
                </div>
            </div>
        </main>

        <?php include 'footer.php'; ?> 
    </body>
</html>
<?php 
// Fechar a conexão
$conn->close(); 
?>