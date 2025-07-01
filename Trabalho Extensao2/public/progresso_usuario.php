<?php
// Configurações de conexão PostgreSQL
$host = "localhost";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "postgres";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o ID do usuário foi passado
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;
    if (!$id) {
        die("ID do usuário não fornecido.");
    }

    // Busca dados do usuário + soma dos pontos
    $stmt = $pdo->prepare("
        SELECT u.*, COALESCE(SUM(p.valor), 0) AS pontos
        FROM usuarios u
        LEFT JOIN pontos p ON p.usuario_id = u.id
        WHERE u.id = :id
        GROUP BY u.id
    ");
    $stmt->execute(['id' => $id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        die("Usuário não encontrado!");
    }

} catch (PDOException $e) {
    die("Erro na conexão ou consulta ao banco: " . $e->getMessage());
}

// Lista de prêmios disponíveis
$premios = [
    ['nome' => 'PS5', 'pontos' => 200, 'imagem' => '/imagens/ps5.png'],
    ['nome' => 'iPhone', 'pontos' => 150, 'imagem' => '/imagens/iphone.png'],
    ['nome' => 'Caneca Personalizada', 'pontos' => 50, 'imagem' => '/imagens/caneca.png'],
    ['nome' => 'Camiseta', 'pontos' => 30, 'imagem' => '/imagens/camisa.png'],
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Progresso de Pontos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            background: white;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #004080;
            font-weight: 700;
            font-size: 28px;
        }
        .user-info {
            background: #e9f0fc;
            padding: 20px 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: inset 0 0 6px #c2d1f0;
        }
        .user-info p {
            font-size: 16px;
            margin: 8px 0;
        }
        h3 {
            color: #004080;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 22px;
            border-bottom: 2px solid #004080;
            padding-bottom: 5px;
        }
        .rewards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .reward-box {
            width: 150px;
            background: #f1f5fb;
            border-radius: 10px;
            text-align: center;
            padding: 15px 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
            cursor: default;
            user-select: none;
        }
        .reward-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .reward-image {
            max-width: 100px;
            height: auto;
            margin-bottom: 10px;
        }
        .reward-box h4 {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 6px;
            color: #222;
        }
        .reward-box p {
            font-weight: 600;
            color: #555;
        }
        .conquistado {
            border: 3px solid #28a745;
            background: #e6f5ea;
            color: #1e7e34;
        }
        .nao-conquistado {
            border: 3px solid #ccc;
            background: #fafafa;
            color: #aaa;
            filter: grayscale(0.7);
        }
        button {
            display: block;
            margin: 40px auto 0;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 25px;
            background-color: #004080;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #002a57;
        }
    </style>
</head>
<body>

<h2>Progresso de Pontos de <?php echo htmlspecialchars($usuario['nome']); ?></h2>

<div class="user-info">
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['nome']); ?></p>
    <p><strong>CPF:</strong> <?php echo htmlspecialchars($usuario['cpf']); ?></p>
    <p><strong>Pontos:</strong> <?php echo $usuario['pontos']; ?> pontos</p>
    <p><strong>Endereço:</strong> <?php echo htmlspecialchars($usuario['endereco']); ?></p>
    <p><strong>Telefone:</strong> <?php echo htmlspecialchars($usuario['telefone']); ?></p>
</div>

<h3>Prêmios Disponíveis</h3>
<div class="rewards">
    <?php foreach ($premios as $premio):
        $status = ($usuario['pontos'] >= $premio['pontos']) ? 'conquistado' : 'nao-conquistado';
    ?>
        <div class="reward-box <?php echo $status; ?>">
            <img src="<?php echo $premio['imagem']; ?>" alt="<?php echo htmlspecialchars($premio['nome']); ?>" class="reward-image" />
            <h4><?php echo htmlspecialchars($premio['nome']); ?></h4>
            <p><strong><?php echo $premio['pontos']; ?> pontos</strong></p>
        </div>
    <?php endforeach; ?>
</div>

<button onclick="window.location.href='/public/index.php'">Voltar para Início</button>

</body>
</html>
