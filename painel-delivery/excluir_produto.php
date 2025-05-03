<?php
session_start();
if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit; }

$id = $_GET['id'];
$produtos = json_decode(file_get_contents('produtos.json'), true);

if (isset($produtos[$id])) {
  // remove imagem
  if (!empty($produtos[$id]['imagem']) && file_exists($produtos[$id]['imagem'])) {
    unlink($produtos[$id]['imagem']);
  }
  unset($produtos[$id]);
  $produtos = array_values($produtos);
  file_put_contents('produtos.json', json_encode($produtos, JSON_PRETTY_PRINT));
}

header('Location: produtos.php');
exit;
?>
