<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>Cálculo Gasto Viagem</h1>
<form method="POST" action="/viagem/calcular">
    @csrf
    <label>Distância (km): <input type="number" name="distancia"></label><br>
    <label>Consumo (km/l): <input type="number" name="consumo"></label><br>
    <label>Preço Combustível (R$): <input type="number" name="preco" step="0.01"></label><br>
    <button type="submit">Calcular</button>
</form>
@isset($gasto)
    <p>Gasto estimado: R$ {{ number_format($gasto, 2, ',', '.') }}</p>
@endisset


</body>
</html>