<?php
require_once 'db.php';

// Cek apakah user sudah login
if (empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$userid = $_SESSION['user_id'];
$nama = htmlspecialchars($_SESSION['namalengkap']);
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard - Pendaftaran Kelas Khusus</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/htmx.org@1.9.10"></script>
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Selamat Datang, <?= $nama; ?></h3>
    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
  </div>

  <div class="card mb-4">
    <div class="card-body">
      <h5>Pendaftaran Kelas</h5>
      <form hx-post="register_class.php" hx-target="#table-registrations" hx-swap="beforeend">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">NIM</label>
            <input name="nim" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Nama Mata Kuliah</label>
            <input name="nama_mk" class="form-control" required>
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-success w-100" type="submit">Daftar</button>
          </div>
        </div>
        <input type="hidden" name="user_id" value="<?= $userid ?>">
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h5>Daftar Pendaftar</h5>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>NIM</th>
            <th>Nama Mata Kuliah</th>
            <th>Tanggal Daftar</th>
          </tr>
        </thead>
        <tbody id="table-registrations">
          <?php
          $stmt = $pdo->prepare("SELECT nim, nama_mk, registered_at FROM registrations WHERE user_id = ?");
          $stmt->execute([$userid]);
          foreach ($stmt as $row):
          ?>
          <tr>
            <td><?= htmlspecialchars($row['nim']); ?></td>
            <td><?= htmlspecialchars($row['nama_mk']); ?></td>
            <td><?= htmlspecialchars($row['registered_at']); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
</body>
</html>
