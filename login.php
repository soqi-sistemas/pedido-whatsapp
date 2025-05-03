<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  if ($user === 'admin' && $pass === '123456') {
    $_SESSION['admin'] = true;
    header('Location: dashboard.php');
    exit;
  } else {
    $error = "Usuário ou senha inválidos.";
  }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login - Painel Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center vh-100">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-body">
            <h3 class="text-center mb-4">Painel Delivery</h3>
            <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <form method="POST">
              <div class="mb-3">
                <label class="form-label">Usuário</label>
                <input type="text" name="user" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" name="pass" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
          </div>
        </div>
        <p class="text-center mt-3 text-muted">admin / 123456</p>
      </div>
    </div>
  </div>
</body>
</html>
