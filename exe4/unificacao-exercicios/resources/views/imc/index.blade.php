<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2.5rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
        
        form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 20px;
            color: #34495e;
            font-weight: 500;
        }
        
        input {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        input:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 2px rgba(52,152,219,0.2);
        }
        
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            width: 100%;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #2980b9;
        }
        
        p {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            color: #2c3e50;
            font-size: 1.2rem;
            text-align: center;
            width: 100%;
            max-width: 400px;
            margin-top: 20px;
        }
        
        @media (max-width: 480px) {
            h1 {
                font-size: 2rem;
            }
            
            form, p {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    
    <h1>Calcular IMC</h1>
    <form method="POST" action="/imc/calcular">
        @csrf
        <label>Peso (kg): <input type="number" name="peso" step="0.1" required></label>
        <label>Altura (m): <input type="number" name="altura" step="0.01" required></label>
        <button type="submit">Calcular</button>
    </form>
    @isset($imc)
        <p>Seu IMC é: {{ $imc }}</p>
    @endisset

    <a href="index.php" class="btn-voltar button">Voltar à Página Inicial</a>


</body>
</html>