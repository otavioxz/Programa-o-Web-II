<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Qualidade do Sono</title>
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
            font-size: 1.1rem;
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
            border-color: #9b59b6;
            outline: none;
            box-shadow: 0 0 0 2px rgba(155,89,182,0.2);
        }
        
        button {
            background-color: #9b59b6;
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
            background-color: #8e44ad;
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
            line-height: 1.6;
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
    
    <h1>Avaliação do Sono</h1>
    <form method="POST" action="/sono/avaliar">
        @csrf
        <label>Horas de Sono: <input type="number" name="horas" min="0" max="24" step="0.5" required></label>
        <button type="submit">Avaliar</button>
    </form>
    @isset($avaliacao)
        <p>{{ $avaliacao }}</p>
    @endisset

    <a href="index.php" class="btn-voltar button">Voltar à Página Inicial</a>


</body>
</html>