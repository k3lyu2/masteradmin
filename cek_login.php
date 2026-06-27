<?php
session_start();

require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/timeout.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['pesan_login'] = 'Username dan password wajib diisi.';
    header('Location: index.php');
    exit;
}

// MD5 dipertahankan agar cocok dengan format password pada modul praktikum.
$passwordHash = md5($password);
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT id_users, username, password, nama_lengkap, email, no_telp, hakakses, blokir, foto, id_session
     FROM users
     WHERE username = ? AND password = ? AND blokir = 'N'
     LIMIT 1"
);
mysqli_stmt_bind_param($stmt, 'ss', $username, $passwordHash);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($hasil);

if (!$user) {
    $_SESSION['pesan_login'] = 'Username atau password salah, atau akun sedang diblokir.';
    header('Location: index.php');
    exit;
}

session_regenerate_id(true);
$_SESSION['login'] = 1;
$_SESSION['idusers'] = (int) $user['id_users'];
$_SESSION['namauser'] = $user['username'];
$_SESSION['namalengkap'] = $user['nama_lengkap'];
$_SESSION['passuser'] = $user['password'];
$_SESSION['leveluser'] = $user['hakakses'];
$_SESSION['foto'] = $user['foto'] ?: 'default-user.svg';
timer();

$sessionId = session_id();
$update = mysqli_prepare($koneksi, 'UPDATE users SET id_session = ? WHERE id_users = ?');
mysqli_stmt_bind_param($update, 'si', $sessionId, $user['id_users']);
mysqli_stmt_execute($update);

header('Location: media.php?module=home');
exit;

