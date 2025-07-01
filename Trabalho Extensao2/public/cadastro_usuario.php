<?php
// Conexão com o banco de dados PostgreSQL
$host = 'localhost';
$port = '5432';
$dbname = 'postgres';      // substitua pelo nome do seu banco
$user = 'postgres';         // substitua pelo seu usuário
$password = 'postgres';    // substitua pela sua senha

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Erro na conexão com o banco de dados.");
}

// Inicializa variável para mensagens
$msg = '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $cpf = trim($_POST['cpf']);
    $endereco = trim($_POST['endereco']);
    $telefone = trim($_POST['telefone']);
    $senha = trim($_POST['senha']);


    $query = "INSERT INTO usuarios (nome, cpf, endereco, telefone, senha) VALUES ($1, $2, $3, $4, $5)";
    $result = pg_query_params($conn, $query, array($nome, $cpf, $endereco, $telefone, $senha));

    if ($result) {
        $msg = "<div style='color:green;'>Usuário cadastrado com sucesso!</div>";
    } else {
        $msg = "<div style='color:red;'>Erro ao cadastrar usuário.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Cadastro de Usuário</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        form { max-width: 400px; }
        label { display: block; margin-top: 15px; }
        input[type="text"] { width: 100%; padding: 8px; box-sizing: border-box; }
        button { margin-top: 20px; padding: 10px 15px; background-color: #2E8B57; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #246b45; }
        .msg { margin-top: 15px; }
    </style>
</head>
<body>

    <h2>Cadastro de Usuário</h2>

    <?php if ($msg) echo "<div class='msg'>$msg</div>"; ?>

    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required />

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" required />

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" id="endereco" required />

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required />

        <label for="senha">Senha:</label>
        <input type="text" name="senha" id="senha" required />


        <button type="submit">Cadastrar</button>
    </form>

    <button onclick="window.location.href='/public/index.php'" style="margin-top: 10px;">Voltar para Início</button>


</body>
</html>
