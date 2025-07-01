<?php
$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres");
if (!$conn) {
    die("Erro ao conectar ao banco de dados.");
}

$pesquisa = $_POST['pesquisa'] ?? '';
$filtro = '%' . strtolower($pesquisa) . '%';

$sql = "SELECT 
    u.id, 
    u.nome, 
    u.cpf, 
    COALESCE(SUM(p.valor), 0) AS pontos
FROM usuarios u
LEFT JOIN pontos p ON p.usuario_id = u.id
WHERE LOWER(u.nome) LIKE $1 OR u.cpf LIKE $1
GROUP BY u.id, u.nome, u.cpf
ORDER BY pontos DESC";

$result = pg_query_params($conn, $sql, array($filtro));

$usuariosFiltrados = [];
if ($result) {
    while ($row = pg_fetch_assoc($result)) {
        $usuariosFiltrados[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Sistema de Pontos - Pesquisa</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<style>
  /* Reset básico */
  * {
    box-sizing: border-box;
  }
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9fafb;
    margin: 0;
    padding: 20px;
    color: #333;
  }
  .form-container {
    max-width: 700px;
    background: #fff;
    margin: 0 auto;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
  }
  h2, h3 {
    margin-top: 0;
    color: #1e40af;
    font-weight: 700;
  }
  form {
    display: flex;
    gap: 15px;
    margin-bottom: 25px;
  }
  input[type="text"] {
    flex-grow: 1;
    padding: 12px 15px;
    font-size: 1rem;
    border: 2px solid #cbd5e1;
    border-radius: 8px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }
  input[type="text"]:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 8px #3b82f6aa;
    outline: none;
  }
  button {
    background-color: #3b82f6;
    border: none;
    color: white;
    font-size: 1rem;
    padding: 12px 24px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  button:hover {
    background-color: #2563eb;
  }
  .usuarios-container {
    display: flex;
    flex-direction: column;
    gap: 18px;
  }
  .usuario-box {
    display: flex;
    align-items: center;
    background: #e0e7ff;
    padding: 18px 24px;
    border-radius: 14px;
    box-shadow: inset 0 0 5px rgba(0,0,0,0.05);
    transition: background-color 0.3s ease;
  }
  .usuario-box:hover {
    background-color: #c7d2fe;
  }
  .usuario-box i.fa-user-circle {
    font-size: 54px;
    color: #4338ca;
    flex-shrink: 0;
  }
  .usuario-info {
    flex-grow: 1;
    margin-left: 22px;
  }
  .usuario-info p {
    margin: 4px 0;
    font-weight: 600;
    color: #1e293b;
  }
  .pontos {
    font-weight: 700;
    font-size: 1.15rem;
    color: #1e40af;
    margin-right: 25px;
    min-width: 100px;
    text-align: right;
    user-select: none;
  }
  .btn {
    background-color: #2563eb;
    color: white;
    padding: 10px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease;
    user-select: none;
  }
  .btn:hover {
    background-color: #1e40af;
  }
  /* Responsividade */
  @media (max-width: 600px) {
    form {
      flex-direction: column;
    }
    input[type="text"], button {
      width: 100%;
      margin: 0;
    }
    .usuario-box {
      flex-direction: column;
      align-items: flex-start;
      gap: 10px;
    }
    .pontos {
      margin: 0;
      text-align: left;
      min-width: auto;
    }
  }
</style>
</head>
<body>

<div class="form-container" role="main" aria-label="Formulário de pesquisa de usuários">
  <h2>Pesquisar Usuário</h2>
  <form method="POST" action="pesquisa.php" autocomplete="off" aria-label="Pesquisar usuários por nome ou CPF">
    <input type="text" name="pesquisa" placeholder="Buscar por nome ou CPF" value="<?php echo htmlspecialchars($pesquisa); ?>" required aria-required="true" aria-describedby="pesquisaHelp" />
    <button type="submit" aria-label="Botão pesquisar"><i class="fas fa-search" aria-hidden="true"></i> Pesquisar</button>
  </form>

  <h3>Usuários encontrados:</h3>
  <div class="usuarios-container">
    <?php if (count($usuariosFiltrados) > 0): ?>
      <?php foreach ($usuariosFiltrados as $usuario): ?>
        <div class="usuario-box" tabindex="0" role="region" aria-label="Informações do usuário <?php echo htmlspecialchars($usuario['nome']); ?>">
          <i class="fas fa-user-circle" aria-hidden="true"></i>
          <div class="usuario-info">
            <p><strong><?php echo htmlspecialchars($usuario['nome']); ?></strong></p>
            <p>CPF: <?php echo htmlspecialchars($usuario['cpf']); ?></p>
          </div>
          <div class="pontos" aria-live="polite" aria-atomic="true"><?php echo $usuario['pontos']; ?> pontos</div>
          <a href="progresso_usuario.php?id=<?php echo $usuario['id']; ?>" class="btn" title="Ver detalhes do usuário <?php echo htmlspecialchars($usuario['nome']); ?>">Detalhes</a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Nenhum usuário encontrado.</p>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
