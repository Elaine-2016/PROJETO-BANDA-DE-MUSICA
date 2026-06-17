javascript
// Aguarda o carregamento completo do DOM
document.addEventListener('DOMContentLoaded', function () {
    
    // --- Bloco 1: Validação do Formulário de Contacto ---
    
    const form = document.getElementById('contact-form');
    const successMessage = document.getElementById('success-message');

    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Impede o envio padrão
            event.stopPropagation();

            if (form.checkValidity() === false) {
                // Se inválido, mostra os erros do Bootstrap
                form.classList.add('was-validated');
            } else {
                // Se válido, esconde o formulário e mostra a mensagem de sucesso
                console.log('Formulário válido, simulando envio...');
                form.classList.add('d-none');
                successMessage.classList.remove('d-none');
                window.scrollTo(0, 0); // Rola para o topo
            }
        }, false);
    }

    // --- Bloco 2: Funcionalidade do Player de Música "Recent Works" ---

    // Cria um único "motor" de áudio para a página
    const audioPlayer = new Audio();
    let currentPlayingButton = null; // Guarda qual botão está a tocar

    // Encontra todos os botões de play da secção
    const allPlayButtons = document.querySelectorAll('#recent-works .play-button');

    allPlayButtons.forEach(button => {
        button.addEventListener('click', function () {
            
            const songSrc = button.dataset.src; // Pega o MP3 do atributo data-src
            const icon = button.querySelector('i');

            if (currentPlayingButton === button && !audioPlayer.paused) {
                // Se clicar no botão que já está a tocar, pausa
                audioPlayer.pause();
                icon.classList.remove('fa-pause');
                icon.classList.add('fa-play');
                currentPlayingButton = null;

            } else {
                // Se é uma música nova ou estava pausada

                // 1. Para todos os outros botões e garante que mostram "play"
                allPlayButtons.forEach(btn => {
                    if (btn !== button) {
                        btn.querySelector('i').classList.remove('fa-pause');
                        btn.querySelector('i').classList.add('fa-play');
                    }
                });

                // 2. Define a música nova e toca
                audioPlayer.src = songSrc;
                audioPlayer.play();

                // 3. Atualiza o ícone do botão atual para "pause"
                icon.classList.remove('fa-play');
                icon.classList.add('fa-pause');
                currentPlayingButton = button;
            }
        });
    });

    // Se a música terminar, volta a mostrar o ícone "play"
    audioPlayer.addEventListener('ended', () => {
        if (currentPlayingButton) {
            const icon = currentPlayingButton.querySelector('i');
            icon.classList.remove('fa-pause');
            icon.classList.add('fa-play');
            currentPlayingButton = null;
        }
    });

});