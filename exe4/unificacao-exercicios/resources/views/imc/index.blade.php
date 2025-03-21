<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>Calcular IMC</h1>
<form method="POST" action="/imc/calcular">
    @csrf
    <label>Peso (kg): <input type="number" name="peso" step="0.1"></label><br>
    <label>Altura (m): <input type="number" name="altura" step="0.01"></label><br>
    <button type="submit">Calcular</button>
</form>
@isset($imc)
    <p>Seu IMC é: {{ $imc }}</p>
@endisset


</body>
</html>