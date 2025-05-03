<?php
session_start();
if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit; }

$produto = [
  'nome' => $_POST['nome'],
  'categoria' => $_POST['categoria'],
  'sabores' => $_POST['sabores'],
  'precos' => [
    'media' => $_POST['preco_media'],
    'grande' => $_POST['preco_grande'],
    'familia' => $_POST['preco_familia'],
    'superfamilia' => $_POST['preco_superfamilia']
  ],
  'imagem' => ''
];

if (!empty($_FILES['imagem']['name'])) {
  $nome_arquivo = 'uploads/' . uniqid() . '_' . basename($_FILES['imagem']['name']);
  move_uploaded_file($_FILES['imagem']['tmp_name'], $nome_arquivo);
  $produto['imagem'] = $nome_arquivo;
}

$data = json_decode(file_get_contents('produtos.json'), true) ?? [];
$data[] = $produto;
file_put_contents('produtos.json', json_encode($data, JSON_PRETTY_PRINT));

header('Location: produtos.php');
exit;
?>
