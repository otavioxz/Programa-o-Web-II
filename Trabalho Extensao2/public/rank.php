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

    // Ajuste o nome da coluna para a sua estrutura
    $stmt = $pdo->query("
        SELECT 
            u.id,
            u.nome, 
            COALESCE(SUM(p.valor), 0) AS pontos
        FROM usuarios u
        LEFT JOIN pontos p ON p.usuario_id = u.id
        GROUP BY u.id, u.nome
        ORDER BY pontos DESC
        LIMIT 3
    ");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro na conexão ou consulta ao banco: " . $e->getMessage());
}

// Função para reorganizar o pódio
function reorganizarPodio($top3) {
    if (!is_array($top3) || count($top3) < 3) return $top3;

    $pontos = array_column($top3, 'pontos');
    $maxIndex = array_search(max($pontos), $pontos);

    $novoPodio = [];
    $novoPodio[1] = $top3[$maxIndex];

    $outros = [];
    foreach ($top3 as $i => $user) {
        if ($i !== $maxIndex) $outros[] = $user;
    }

    $novoPodio[0] = $outros[0];
    $novoPodio[2] = $outros[1];

    ksort($novoPodio);

    return $novoPodio;
}

$top3 = reorganizarPodio($usuarios);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Ranking - Pódio</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f9fafb; margin: 40px auto; max-width: 600px;">

  <h2 style="text-align:center; color:#222; margin-bottom: 30px;">Ranking dos Usuários</h2>

  <div style="display: flex; justify-content: center; align-items: flex-end; gap: 20px;">

    <?php foreach ($top3 as $idx => $user): 
      // Define tamanho e cores conforme posição
      $height = $idx === 1 ? '220px' : ($idx === 0 ? '180px' : '140px'); // meio maior, esquerda média, direita menor
      $bgColor = $idx === 1 ? '#ffd700' : ($idx === 0 ? '#c0c0c0' : '#cd7f32'); // ouro, prata, bronze
      $nameColor = '#fff';
      $fontSizeName = $idx === 1 ? '1.5rem' : ($idx === 0 ? '1.3rem' : '1.1rem');
      $fontSizePontos = $idx === 1 ? '1.3rem' : ($idx === 0 ? '1.1rem' : '1rem');
    ?>
      <div style="background: <?php echo $bgColor; ?>; height: <?php echo $height; ?>; width: 130px; border-radius: 15px 15px 0 0; box-shadow: 0 6px 10px rgba(0,0,0,0.1); display: flex; flex-direction: column; align-items: center; justify-content: flex-end; padding: 15px; cursor: default;">
        <div style="color: <?php echo $nameColor; ?>; font-weight: 700; font-size: <?php echo $fontSizeName; ?>; margin-bottom: 10px; text-align:center; word-wrap: break-word;">
          <?php echo htmlspecialchars($user['nome']); ?>
        </div>
        <div style="color: #e6e6e6; font-weight: 600; font-size: <?php echo $fontSizePontos; ?>;">
          <?php echo htmlspecialchars($user['pontos']); ?> pontos
        </div>
      </div>
    <?php endforeach; ?>

  </div>

  <div style="text-align: center; margin-top: 40px;">
    <button onclick="window.location.href='/public/index.php'" 
      style="padding: 12px 30px; font-size: 16px; font-weight: 600; border: none; border-radius: 25px; background-color: #004080; color: white; cursor: pointer; transition: background-color 0.3s ease;">
      Voltar para Início
    </button>
  </div>

</body>
</html>
