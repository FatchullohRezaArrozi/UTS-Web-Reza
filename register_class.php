<?php
require_once 'db.php';

$nim = trim($_POST['nim'] ?? '');
$nama_mk = trim($_POST['nama_mk'] ?? '');
$user_id = $_POST['user_id'] ?? null;

if ($nim === '' || $nama_mk === '' || !$user_id) {
    echo '<tr><td colspan="3" class="text-danger">Input tidak lengkap!</td></tr>';
    exit;
}

$stmt = $pdo->prepare("INSERT INTO registrations (user_id, nim, nama_mk) VALUES (?, ?, ?)");
$stmt->execute([$user_id, $nim, $nama_mk]);

echo '<tr>
        <td>' . htmlspecialchars($nim) . '</td>
        <td>' . htmlspecialchars($nama_mk) . '</td>
        <td>' . date("Y-m-d H:i:s") . '</td>
      </tr>';
?>
