<?php
require_once 'db.php';

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username === '' || $password === '') {
    echo '<div class="text-danger">Semua kolom wajib diisi.</div>';
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['namalengkap'] = $user['namalengkap'];
    echo "<script>window.location.href='dashboard.php';</script>";
} else {
    echo '<div class="text-danger">Username atau password salah.</div>';
}
?>
