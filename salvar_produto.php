<?php
include 'auth.php';
include 'supabase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $produto = [
    'nome' => $_POST['nome'],
    'categoria' => $_POST['categoria'],
    'sabores' => $_POST['sabores'],
    'precos' => json_encode([
      'media' => $_POST['media'],
      'grande' => $_POST['grande']
    ]),
    'imagem' => $_POST['imagem']
  ];
  supabase_salvar_produto($produto);
  header("Location: produtos.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Novo Produto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h2>Novo Produto</h2>
  <form method="post">
    <div class="mb-2">
      <label>Nome</label>
      <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-2">
      <label>Categoria</label>
      <select name="categoria" class="form-select">
        <option value="pizza">Pizza</option>
        <option value="lanche">Lanche</option>
        <option value="porcao">Porção</option>
        <option value="refrigerante">Refrigerante</option>
      </select>
    </div>
    <div class="mb-2">
      <label>Sabores</label>
      <input type="text" name="sabores" class="form-control">
    </div>
    <div class="mb-2">
      <label>Preço Médio</label>
      <input type="number" step="0.01" name="media" class="form-control">
    </div>
    <div class="mb-2">
      <label>Preço Grande</label>
      <input type="number" step="0.01" name="grande" class="form-control">
    </div>
    <div class="mb-2">
      <label>URL da Imagem</label>
      <input type="text" name="imagem" class="form-control">
    </div>
    <button class="btn btn-success">Salvar</button>
  </form>
</body>
</html>
