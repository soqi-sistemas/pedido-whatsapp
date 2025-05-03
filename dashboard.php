<?php
include 'auth.php';
include 'supabase.php';

$produtos = supabase_get_produtos();
$categorias = [];
foreach ($produtos as $p) {
    $cat = strtolower($p['categoria']);
    $categorias[$cat] = ($categorias[$cat] ?? 0) + 1;
}

// Buscar pedidos
function supabase_get_pedidos() {
    $url = SUPABASE_URL . "/rest/v1/pedidos?select=*&order=created_at.desc";
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "apikey: " . SUPABASE_KEY,
            "Authorization: Bearer " . SUPABASE_KEY,
        ]
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true);
}
$pedidos = supabase_get_pedidos();

// Contagem por dia
$datas = [];
foreach ($pedidos as $p) {
    $dia = substr($p['created_at'], 0, 10);
    $datas[$dia] = ($datas[$dia] ?? 0) + 1;
}

// Buscar config ON/OFF
function supabase_get_config() {
    $url = SUPABASE_URL . "/rest/v1/config?select=*";
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "apikey: " . SUPABASE_KEY,
            "Authorization: Bearer " . SUPABASE_KEY
        ]
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    $conf = json_decode($res, true);
    return $conf[0] ?? ['pedidos_ativos' => true];
}

function supabase_set_config($status) {
    $url = SUPABASE_URL . "/rest/v1/config?id=eq.1";
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "PATCH",
        CURLOPT_POSTFIELDS => json_encode(['pedidos_ativos' => $status]),
        CURLOPT_HTTPHEADER => [
            "apikey: " . SUPABASE_KEY,
            "Authorization: Bearer " . SUPABASE_KEY,
            "Content-Type: application/json"
        ]
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
}

if (isset($_GET['toggle'])) {
    $novo = $_GET['toggle'] === 'on' ? true : false;
    supabase_set_config($novo);
    header("Location: dashboard.php");
    exit;
}

$config = supabase_get_config();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="container py-4">
  <h2 class="mb-4">Painel Delivery</h2>
  <a href="produtos.php" class="btn btn-primary mb-3">Gerenciar Produtos</a>
  <a href="logout.php" class="btn btn-danger mb-3">Sair</a>

  <div class="card p-4 mb-4">
    <h5>Status dos Pedidos: 
      <span class="badge bg-<?= $config['pedidos_ativos'] ? 'success' : 'secondary' ?>">
        <?= $config['pedidos_ativos'] ? 'Ativo' : 'Inativo' ?>
      </span>
    </h5>
    <a href="?toggle=<?= $config['pedidos_ativos'] ? 'off' : 'on' ?>" class="btn btn-sm btn-outline-primary">
      <?= $config['pedidos_ativos'] ? 'Desativar Pedidos' : 'Ativar Pedidos' ?>
    </a>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card p-4 mb-4">
        <h5>Resumo por Categoria</h5>
        <canvas id="catChart" height="200"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4 mb-4">
        <h5>Pedidos por Dia</h5>
        <canvas id="pedChart" height="200"></canvas>
      </div>
    </div>
  </div>

  <script>
    new Chart(document.getElementById('catChart'), {
      type: 'bar',
      data: {
        labels: <?= json_encode(array_keys($categorias)) ?>,
        datasets: [{
          label: 'Qtd de Produtos',
          data: <?= json_encode(array_values($categorias)) ?>,
          backgroundColor: ['#36a2eb', '#ff6384', '#ffcd56', '#4bc0c0']
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: { beginAtZero: true }
        }
      }
    });

    new Chart(document.getElementById('pedChart'), {
      type: 'line',
      data: {
        labels: <?= json_encode(array_keys($datas)) ?>,
        datasets: [{
          label: 'Pedidos',
          data: <?= json_encode(array_values($datas)) ?>,
          borderColor: '#4caf50',
          fill: false
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: { beginAtZero: true, precision: 0 }
        }
      }
    });
  </script>
</body>
</html>
