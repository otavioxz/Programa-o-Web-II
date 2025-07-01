<?php
// Conexão com o PostgreSQL
$host = 'localhost';
$port = '5432';
$dbname = 'postgres';
$user = 'postgres';
$password = 'postgres';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Erro ao conectar no banco de dados.");
}

// Buscar usuários para o select
$usuarios_res = pg_query($conn, "SELECT id, nome FROM usuarios ORDER BY nome");
$usuarios = pg_fetch_all($usuarios_res);

$msg = '';

// Função para converter qualidade em pontos
function qualidadeParaPontos($qualidade) {
    $qualidade = strtolower(trim($qualidade));
    switch ($qualidade) {
        case 'excelente':
            return 10;
        case 'boa':
            return 7;
        case 'nova':
            return 8;
        case 'premium':
            return 9;
        case 'usado':
            return 4;
        case 'ruim':
            return 2;
        case 'péssima':
            return 0;
        default:
            return 5; // padrão, caso não identifique o texto
    }
}

// Processa o formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $tipo = $_POST['tipo'];
    $item = $_POST['item'];
    $qualidade = $_POST['qualidade'];

    $valor_pontos = qualidadeParaPontos($qualidade);

    $query = "INSERT INTO pontos (usuario_id, tipo, item, qualidade, valor) VALUES ($1, $2, $3, $4, $5)";
    $result = pg_query_params($conn, $query, array($usuario_id, $tipo, $item, $qualidade, $valor_pontos));

    if ($result) {
        $msg = "<div class='alert success'>Pontos adicionados com sucesso! (Valor: $valor_pontos pontos)</div>";
    } else {
        $msg = "<div class='alert error'>Erro ao adicionar pontos.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Adicionar Pontos ao Usuário</title>
    <style>
        /* Seu CSS permanece igual */
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"], .btn-voltar {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="submit"]:hover, .btn-voltar:hover {
            background-color: #0056b3;
        }
        .btn-voltar {
            background-color: #6c757d;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }
        .alert {
            margin-top: 20px;
            padding: 12px;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
        }
        .alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <h2>Adicionar Pontos</h2>

    <?php if ($msg) echo $msg; ?>

    <form method="POST" action="">
        <label for="usuario_id">Usuário:</label>
        <select name="usuario_id" id="usuario_id" required>
            <option value="">Selecione um usuário</option>
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?php echo $usuario['id']; ?>">
                    <?php echo htmlspecialchars($usuario['nome']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" id="tipo" required />

        <label for="item">Item:</label>
        <input type="text" name="item" id="item" required />

        <label for="qualidade">Qualidade:</label>
        <input type="text" name="qualidade" id="qualidade" placeholder="ex: Excelente, Boa, Usado..." />

        <button type="submit">Adicionar Pontos</button>
    </form>
    <div style="margin-top: 30px; padding: 15px; background-color: #eef6fc; border: 1px solid #b8d7f0; border-radius: 6px; color: #333;">
        <h3>Como funciona o campo <em>Qualidade</em>?</h3>
        <p>
            O campo <strong>Qualidade</strong> é opcional e serve para você informar uma característica ou estado do item que está sendo pontuado.<br>
            Exemplos comuns: <em>Excelente</em>, <em>Boa</em>, <em>Usado</em>, <em>Novo</em>, <em>Premium</em>, etc.<br>
            Isso ajuda a detalhar melhor o ponto registrado e pode ser usado para relatórios mais precisos.<br>
            Você pode deixar em branco caso a qualidade não seja relevante.
        </p>
    </div>

    <button class="btn-voltar" onclick="window.location.href='/public/index.php'">Voltar para Início</button>
</body>
</html>
