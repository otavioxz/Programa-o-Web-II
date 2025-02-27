<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Formulário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .data-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .data-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .data-container p {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="data-container">
        <h2>Dados Enviados</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<p><strong>Nome:</strong> " . htmlspecialchars($_POST['nome']) . "</p>";
            echo "<p><strong>Telefone:</strong> " . htmlspecialchars($_POST['telefone']) . "</p>";
            echo "<p><strong>E-mail:</strong> " . htmlspecialchars($_POST['email']) . "</p>";
            echo "<p><strong>Mensagem:</strong> " . htmlspecialchars($_POST['mensagem']) . "</p>";
        } elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo "<p><strong>Nome:</strong> " . htmlspecialchars($_GET['nome']) . "</p>";
            echo "<p><strong>Telefone:</strong> " . htmlspecialchars($_GET['telefone']) . "</p>";
            echo "<p><strong>E-mail:</strong> " . htmlspecialchars($_GET['email']) . "</p>";
            echo "<p><strong>Mensagem:</strong> " . htmlspecialchars($_GET['mensagem']) . "</p>";
        }
        ?>
    </div>

    <div class="data-container">
        <h2>Cabeçalho da Requisição HTTP</h2>
        <?php
        echo "<pre>";
        print_r(getallheaders());
        echo "</pre>";
        ?>
    </div>

    <div class="data-container">
        <h2>Método Utilizado</h2>
        <?php
        echo "<p><strong>Método:</strong> " . $_SERVER['REQUEST_METHOD'] . "</p>";
        ?>
    </div>
</body>
</html>