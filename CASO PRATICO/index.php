<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt">
    <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Site oficial da Banda Kid Abelha. Descubra a história do rock brasileiro com clássicos como Fixação e Como Eu Quero. Confira álbuns, agenda de shows e entre em contato.">
        <meta name="keywords" content="Kid Abelha, banda brasileira, rock nacional, Paula Toller, anos 80, música brasileira, Fixação, Como Eu Quero">
        <meta name="author" content="Elaine Gonçalves">
        <title>Banda Kid Abelha - Página Inicial | Rock Brasileiro dos Anos 80</title>

        <link rel="shortcut icon" href="imagens/favicon.jpg" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
        
        <link rel="stylesheet" href="estilos/style.css" media="all">
        <link rel="stylesheet" href="estilos/media-query.css" media="all">

        
    </head>

    <body class="pagina-index">

        <?php include 'header.php'; ?>

        <main class="main-home text-center py-5">
            <div class="video-wrapper">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/chaWLqoVazQ?si=7xRL9_TlxEjNxx9Y" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            
            <div class="container mt-4">
                <h1>Bem-vindo ao site oficial da Banda Kid Abelha</h1>
                <p><strong>Confira nossas músicas, discografia e próximos concertos.</strong></p>
                <p style="color:rgba(255, 255, 0, 0.986);">A energia Kid Abelha em cada nota! Uma celebração da música brasileira que transcende o tempo.</p>
            </div>
            <div class="container mt-4">
                <audio controls class="custom-audio-player">
                    <source src="audios/www.cabinet-avocat-cadet.fr - Kid Abelha - Nada Sei (Apnéia) (Ao Vivo).mp3" type="audio/mpeg">
                    O seu navegador não suporta o elemento de áudio.
                </audio>
            </div>
        </main>

        <?php include 'footer.php'; ?>

    </body>
</html>
