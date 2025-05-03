<?php
include 'auth.php';
include 'supabase.php';

if (isset($_GET['id'])) {
  supabase_excluir_produto($_GET['id']);
}
header("Location: produtos.php");
exit;
