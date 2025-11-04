<?php
// index.php
require_once 'db.php';

// Jika sudah login, redirect ke dashboard
if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Pendaftaran Kelas Khusus - Login / Registrasi</title>
  <!-- Bootstrap CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- HTMX (CDN) -->
  <script src="https://unpkg.com/htmx.org@1.9.0"></script>
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="card mb-3">
          <div class="card-body">
            <h3 class="card-title">Pendaftaran Kelas Khusus</h3>
            <p class="text-muted">Login atau buat akun baru untuk mendaftar kelas tambahan.</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <!-- Login Form (HTMX) -->
            <div class="card">
              <div class="card-body">
                <h5>Login</h5>
                <form id="login-form" hx-post="login.php" hx-target="#login-feedback" hx-swap="innerHTML">
                  <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input name="username" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" required>
                  </div>
                  <div id="login-feedback" class="mb-2"></div>
                  <button class="btn btn-primary" type="submit">Login</button>
                </form>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <!-- Register Form (HTMX) -->
            <div class="card">
              <div class="card-body">
                <h5>Registrasi</h5>
                <form id="register-form" hx-post="register.php" hx-target="#register-container" hx-swap="outerHTML">
                  <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input name="username" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input name="namalengkap" class="form-control" required>
                  </div>
                  <div id="register-container">
                    <button class="btn btn-success" type="submit">Buat Akun</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div> <!-- row -->
      </div>
    </div>
  </div>

  <!-- bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
