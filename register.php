<?php
require_once 'db.php';

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$namalengkap = trim($_POST['namalengkap'] ?? '');

if ($username === '' || $password === '' || $namalengkap === '') {
    echo '<div class="text-danger">Semua kolom wajib diisi.</div>';
    exit;
}

// Cek apakah username sudah ada
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);
if ($stmt->fetch()) {
    echo '<div class="text-danger">Username sudah digunakan.</div>';
    exit;
}

// Simpan user baru
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, password, namalengkap) VALUES (?, ?, ?)");
$stmt->execute([$username, $hash, $namalengkap]);

echo '<div class="text-success">Akun berhasil dibuat! Silakan login.</div>';
?>
