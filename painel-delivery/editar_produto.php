<?php
include 'auth.php';
$id = $_GET['id'] ?? null;
$produtos = json_decode(file_get_contents('produtos.json'), true);
if (!isset($produtos[$id])) { die('Produto não encontrado.'); }
$p = $produtos[$id];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Produto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <h2>Editar Produto</h2>
  <form action="atualizar_produto.php" method="POST" enctype="multipart/form-data" class="row g-3">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="col-md-4">
      <label class="form-label">Nome do Produto</label>
      <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($p['nome']) ?>" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Categoria</label>
      <select name="categoria" class="form-select" required>
        <?php foreach(['pizza','lanche','porcao','refrigerante'] as $cat): ?>
        <option value="<?= $cat ?>" <?= $cat === $p['categoria'] ? 'selected' : '' ?>><?= ucfirst($cat) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-4">
      <label class="form-label">Nova Imagem (opcional)</label>
      <input type="file" name="imagem" class="form-control" accept="image/*">
    </div>
    <?php foreach (['media', 'grande', 'familia', 'superfamilia'] as $t): ?>
    <div class="col-md-3">
      <label class="form-label">Preço <?= ucfirst($t) ?></label>
      <input type="number" step="0.01" name="preco_<?= $t ?>" value="<?= $p['precos'][$t] ?? '' ?>" class="form-control">
    </div>
    <?php endforeach; ?>
    <div class="col-md-12">
      <label class="form-label">Sabores</label>
      <input type="text" name="sabores" value="<?= htmlspecialchars($p['sabores']) ?>" class="form-control">
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Atualizar Produto</button>
      <a href="produtos.php" class="btn btn-secondary">Voltar</a>
    </div>
  </form>
</div>
</body>
</html>
