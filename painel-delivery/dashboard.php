<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Painel Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <span class="navbar-brand">Painel Delivery</span>
    <div class="ms-auto">
      <a href="logout.php" class="btn btn-outline-light btn-sm">Sair</a>
    </div>
  </nav>
  <div class="container my-4">
    <h2>Dashboard</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
          <div class="card-body">
            <h5 class="card-title">Total de Pedidos</h5>
            <p class="card-text fs-4">123</p>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <canvas id="graficoPedidos"></canvas>
      </div>
    </div>
  </div>
  <script>
    const ctx = document.getElementById('graficoPedidos').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        datasets: [{
          label: 'Pedidos por dia',
          data: [12, 19, 3, 5, 2, 3, 9],
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 2,
          fill: false
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } }
      }
    });
  </script>
</body>
</html>
