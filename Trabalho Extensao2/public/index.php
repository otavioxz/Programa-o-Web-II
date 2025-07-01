<?php
// Conexão com PostgreSQL
$host = 'localhost';
$port = '5432';
$dbname = 'postgres';        // <-- Altere aqui
$user = 'postgres';           // <-- Altere aqui
$password = 'postgres';      // <-- Altere aqui

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Erro ao conectar no banco de dados.");
}

// Consulta: conta quantos usuários estão cadastrados
$result = pg_query($conn, "SELECT COUNT(*) AS total FROM usuarios");
$row = pg_fetch_assoc($result);
$totalUsuarios = $row['total'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Lateral Suspenso com PHP</title>
    <link rel="stylesheet" href="/css/index.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Botão para abrir o menu -->
    <button class="open-btn" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Botão de modo escuro/claro -->
    <button class="theme-toggle-btn" onclick="toggleDarkMode()">
        <i class="fas fa-sun"></i>
    </button>

    <!-- Menu Lateral -->
    <div id="sideMenu" class="side-menu">
        <a href="/public/index.php"><i class="fas fa-home"></i> <span>Início</span></a>
        <a href="/public/cadastro_usuario.php"><i class="fas fa-user-plus"></i> <span>Cadastro</span></a>
        <a href="/public/detalhes_pontos.php"><i class="fas fa-cogs"></i> <span>Pontos</span></a>
        <a href="/public/pesquisa.php"><i class="fas fa-search"></i> <span>Pesquisar</span></a>
        <a href="/public/rank.php"><i class="fas fa-trophy"></i> <span>Ranking</span></a>
        <a href="?page=contato"><i class="fas fa-envelope"></i> <span>Contato</span></a>
    </div>

    <!-- Conteúdo Principal -->
    <div class="content">
        <!-- Caixa centralizada com ícone -->
        <div class="recycle-box">
            <i class="fas fa-recycle"></i>
        </div>

        <!-- Mensagem de boas-vindas com dados -->
        <div class="welcome-message">
            <h1>Bem-vindo ao nosso site!</h1>
            <p>Temos <strong><?php echo $totalUsuarios; ?></strong> usuário(s) cadastrado(s).</p>
            <p>Programação Web 2</p>
        </div>
    </div>

    <script src="/js/script.js"></script>
</body>
</html>
