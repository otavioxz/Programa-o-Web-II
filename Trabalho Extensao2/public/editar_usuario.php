<?php
// Conexão com o PostgreSQL
$host = 'localhost';
$port = '5432';
$dbname = 'postgres';      // Substitua pelo nome do seu banco
$user = 'postgres';         // Substitua pelo seu usuário
$password = 'postgres';    // Substitua pela sua senha

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Erro ao conectar no banco de dados.");
}

// Verifica se foi enviado o ID via GET
if (!isset($_GET['id'])) {
    die("ID do usuário não fornecido.");
}

$id = $_GET['id'];

// Atualização dos dados
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE usuarios SET nome = $1, cpf = $2, endereco = $3, telefone = $4 WHERE id = $5";
    $result = pg_query_params($conn, $sql, [$nome, $cpf, $endereco, $telefone, $id]);

    if ($result) {
        echo "<div class='alert'>Usuário atualizado com sucesso!</div>";
    } else {
        echo "<div class='alert'>Erro ao atualizar o usuário.</div>";
    }
}

// Buscar dados do usuário atual
$sql = "SELECT * FROM usuarios WHERE id = $1";
$result = pg_query_params($conn, $sql, [$id]);

if (pg_num_rows($result) === 0) {
    die("Usuário não encontrado.");
}

$usuario = pg_fetch_assoc($result);
?>
