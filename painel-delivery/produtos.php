<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Produtos - Painel Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <span class="navbar-brand">Painel Delivery</span>
    <div class="ms-auto">
      <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
      <a href="logout.php" class="btn btn-outline-light btn-sm">Sair</a>
    </div>
  </nav>
  <div class="container my-4">
    <h2>Cadastro de Produtos</h2>
    <form action="salvar_produto.php" method="POST" enctype="multipart/form-data" class="row g-3 mb-4">
      <div class="col-md-4">
        <label class="form-label">Nome do Produto</label>
        <input type="text" name="nome" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Categoria</label>
        <select name="categoria" class="form-select" required>
          <option value="pizza">Pizza</option>
          <option value="lanche">Lanche</option>
          <option value="porcao">Porção</option>
          <option value="refrigerante">Refrigerante</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Imagem</label>
        <input type="file" name="imagem" class="form-control" accept="image/*">
      </div>
      <div class="col-md-3">
        <label class="form-label">Preço Média</label>
        <input type="number" step="0.01" name="preco_media" class="form-control">
      </div>
      <div class="col-md-3">
        <label class="form-label">Preço Grande</label>
        <input type="number" step="0.01" name="preco_grande" class="form-control">
      </div>
      <div class="col-md-3">
        <label class="form-label">Preço Família</label>
        <input type="number" step="0.01" name="preco_familia" class="form-control">
      </div>
      <div class="col-md-3">
        <label class="form-label">Preço Super Família</label>
        <input type="number" step="0.01" name="preco_superfamilia" class="form-control">
      </div>
      <div class="col-md-12">
        <label class="form-label">Sabores (separar por vírgula)</label>
        <input type="text" name="sabores" class="form-control">
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-success">Salvar Produto</button>
      </div>
    </form>

    <h4>Produtos Cadastrados</h4>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Imagem</th>
          <th>Nome</th>
          <th>Categoria</th>
          <th>Preços</th>
          <th>Sabores</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $produtos = json_decode(file_get_contents('produtos.json'), true) ?? [];
        foreach ($produtos as $index => $p):
        ?>
        <tr>
          <td><img src="<?= $p['imagem'] ?>" class="thumb" alt=""></td>
          <td><?= htmlspecialchars($p['nome']) ?></td>
          <td><?= ucfirst($p['categoria']) ?></td>
          <td>
            Média: R$<?= $p['precos']['media'] ?? '0.00' ?><br>
            Grande: R$<?= $p['precos']['grande'] ?? '0.00' ?><br>
            Família: R$<?= $p['precos']['familia'] ?? '0.00' ?><br>
            Super: R$<?= $p['precos']['superfamilia'] ?? '0.00' ?>
          </td>
          <td><?= htmlspecialchars($p['sabores']) ?></td>
          <td>
            <a href="editar_produto.php?id=<?= $index ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="excluir_produto.php?id=<?= $index ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja excluir este produto?')">Excluir</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
