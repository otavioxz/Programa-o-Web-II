<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercícios</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Estilização geral */
        body {
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 20px;
        }

        /* Container */
        .container {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Título */
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        /* Lista de opções */
        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 15px 0;
        }

        a {
            display: inline-block;
            width: 100%;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
            font-size: 18px;
            font-weight: bold;
        }

        a:hover {
            background-color: #0056b3;
        }

        /* Responsividade */
        @media (max-width: 600px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    
<div class="container">
    <h1>Escolha uma Opção</h1>
    <ul>
        <li><a href="/imc">Calcular IMC</a></li>
        <li><a href="/sono">Avaliar Sono</a></li>
        <li><a href="/viagem">Cálculo Gasto Viagem</a></li>
    </ul>
</div>

</body>
</html>
