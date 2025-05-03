<?php
session_start();
if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit; }

$id = $_POST['id'];
$produtos = json_decode(file_get_contents('produtos.json'), true);

if (!isset($produtos[$id])) { die('Produto não encontrado.'); }

$produtos[$id]['nome'] = $_POST['nome'];
$produtos[$id]['categoria'] = $_POST['categoria'];
$produtos[$id]['sabores'] = $_POST['sabores'];
$produtos[$id]['precos'] = [
  'media' => $_POST['preco_media'],
  'grande' => $_POST['preco_grande'],
  'familia' => $_POST['preco_familia'],
  'superfamilia' => $_POST['preco_superfamilia']
];

if (!empty($_FILES['imagem']['name'])) {
  $nome_arquivo = 'uploads/' . uniqid() . '_' . basename($_FILES['imagem']['name']);
  move_uploaded_file($_FILES['imagem']['tmp_name'], $nome_arquivo);
  $produtos[$id]['imagem'] = $nome_arquivo;
}

file_put_contents('produtos.json', json_encode($produtos, JSON_PRETTY_PRINT));
header('Location: produtos.php');
exit;
?>
