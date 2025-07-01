// Função para abrir e fechar o menu
function toggleMenu() {
    var menu = document.getElementById('sideMenu');
    menu.classList.toggle('open');  // Alterna a classe 'open' para abrir ou fechar o menu

    // Alterando a margem do conteúdo principal ao abrir/fechar o menu
    var content = document.querySelector('.content');
    content.classList.toggle('shifted'); // Alterna a classe para deslocar o conteúdo

    // Também aplica a classe 'shifted' à seção de prêmios
    var rewardsSection = document.querySelector('.rewards-section');
    rewardsSection.classList.toggle('shifted'); // Alterna o deslocamento da seção de prêmios
}

// Fechar o menu ao clicar fora do menu e do botão
document.addEventListener('click', function(event) {
    var menu = document.getElementById('sideMenu');
    var button = document.querySelector('.open-btn');
    
    // Verifica se o clique foi fora do menu e do botão
    if (!menu.contains(event.target) && !button.contains(event.target)) {
        menu.classList.remove('open');
        var content = document.querySelector('.content');
        content.classList.remove('shifted');
        
        // Remove a classe 'shifted' da seção de prêmios também
        var rewardsSection = document.querySelector('.rewards-section');
        rewardsSection.classList.remove('shifted');
    }
});

// Função para alternar entre os temas claro e escuro
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    
    // Alterando o ícone com base no tema
    const icon = document.querySelector('.theme-toggle-btn i');
    if (document.body.classList.contains('dark-mode')) {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
    } else {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    }

    // Armazena a preferência do tema no localStorage
    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
    }
}

// Verifica se o tema já foi salvo e aplica ao carregar a página
window.addEventListener('load', function() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
        const icon = document.querySelector('.theme-toggle-btn i');
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
    }
});
