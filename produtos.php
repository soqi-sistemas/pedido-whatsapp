<?php
include 'auth.php';
include 'supabase.php';

$produtos = supabase_get_produtos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Produtos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h2 class="mb-4">Produtos Cadastrados</h2>
  <a href="dashboard.php" class="btn btn-secondary mb-3">Voltar</a>
  <a href="salvar_produto.php" class="btn btn-primary mb-3">Novo Produto</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nome</th><th>Categoria</th><th>Sabores</th><th>Preços</th><th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($produtos as $p): ?>
      <tr>
        <td><?= htmlspecialchars($p['nome']) ?></td>
        <td><?= htmlspecialchars($p['categoria']) ?></td>
        <td><?= htmlspecialchars($p['sabores']) ?></td>
        <td>
          <?php foreach(json_decode($p['precos'], true) as $t => $v): ?>
            <?= ucfirst($t) ?>: R$<?= $v ?><br>
          <?php endforeach; ?>
        </td>
        <td>
          <a href="editar_produto.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
          <a href="excluir_produto.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
