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
        <meta name="keywords" content="Kid Abelha, contacto, formulário, mensagem, banda">
        <meta name="description" content="Entre em contacto com a Banda Kid Abelha. Envie sua mensagem, sugestões ou pedidos de informações através do nosso formulário seguro.">
        <meta name="author" content="Elaine Gonçalves">
        <link rel="shortcut icon" href="imagens/favicon.jpg" type="image/x-icon">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 

        <link rel="stylesheet" href="estilos/style.css" media="all">
        <link rel="stylesheet" href="estilos/media-query.css" media="all">

        <title>Contactos - Banda Kid Abelha | Envie sua Mensagem</title>

        <script defer src="main.js"></script>
    </head>

    <body class="pagina-contatos">
        
        <?php include 'header.php'; ?>
    
        <main class="container-fluid main-contatos">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="text-center">Entre em Contacto</h1>
                    <p class="text-center">Envie-nos a sua mensagem, sugestão ou pedido de informação.</p>

                    <div id="success-message" class="alert alert-success d-none" role="alert" aria-live="polite">
                        <strong>Mensagem enviada com sucesso!</strong> Obrigado pelo seu contacto.
                    </div>

                    <form id="contact-form" class="needs-validation contact-form" novalidate aria-label="Formulário de contacto" autocomplete="on">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nome" class="form-label">Nome *</label>
                                <input type="text" 
                                    class="form-control" 
                                    id="nome" 
                                    name="nome"
                                    required 
                                    minlength="5"
                                    maxlength="20"
                                    aria-required="true"
                                    aria-describedby="nome-feedback">                                   
                                <div id="nome-feedback" class="invalid-feedback">
                                    O nome é obrigatório e deve ter pelo menos 5 caracteres.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apelido" class="form-label">Apelido *</label>
                                <input type="text" 
                                    class="form-control" 
                                    id="apelido" 
                                    name="apelido"
                                    required 
                                    minlength="5"
                                    maxlength="20"
                                    aria-required="true"
                                    aria-describedby="apelido-feedback">
                                <div id="apelido-feedback" class="invalid-feedback">
                                    O apelido é obrigatório e deve ter pelo menos 5 caracteres.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="data-nascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" 
                                class="form-control" 
                                id="data-nascimento"
                                name="data-nascimento"
                                aria-label="Data de nascimento">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" 
                                class="form-control" 
                                id="email" 
                                name="email"
                                autocomplete="email"
                                required
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                aria-required="true"
                                aria-describedby="email-feedback">
                            <div id="email-feedback" class="invalid-feedback">
                                Por favor, insira um email válido (ex: email@dominio.com).
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="tel" 
                                class="form-control" 
                                id="telefone" 
                                name="telefone"
                                autocomplete="tel"
                                pattern="^\(\d{2}\)\d{4,5}-\d{4}$"
                                placeholder="(xx)xxxx-xxxx"
                                required
                                aria-describedby="telefone-feedback">
                            <div id="telefone-feedback" class="invalid-feedback">
                                O telefone deve conter exatamente 9 dígitos (ex: 912345678).
                            </div>    
                        </div>
                        <div class="mb-3">
                            <label for="mensagem" class="form-label">Mensagem *</label>
                            <textarea class="form-control" 
                                    id="mensagem" 
                                    name="mensagem"
                                    rows="5" 
                                    required 
                                    minlength="10"
                                    aria-required="true"
                                    aria-describedby="mensagem-feedback"></textarea>
                            <div id="mensagem-feedback" class="invalid-feedback">
                                A mensagem é obrigatória e deve ter pelo menos 10 caracteres.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enviar Mensagem</button>
                        <br>
                        <br>
                        <button type="reset" class="btn btn-primary w-100">Limpar</button>
                    </form>
                </div>
            </div>
        </main>

        <?php include 'footer.php'; ?>  
        
        <script src="js/main.js"></script>
    </body>
</html>
<?php 
// Fechar a conexão
$conn->close(); 
?>