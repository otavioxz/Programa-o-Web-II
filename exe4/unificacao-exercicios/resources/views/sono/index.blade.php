<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>Avaliação do Sono</h1>
<form method="POST" action="/sono/avaliar">
    @csrf
    <label>Horas de Sono: <input type="number" name="horas"></label><br>
    <button type="submit">Avaliar</button>
</form>
@isset($avaliacao)
    <p>{{ $avaliacao }}</p>
@endisset

</body>
</html>