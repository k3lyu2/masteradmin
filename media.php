<?php
session_start();

require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../config/library.php';
require_once __DIR__ . '/../config/fungsi_indotgl.php';
require_once __DIR__ . '/../config/fungsi_aplikasi.php';
require_once __DIR__ . '/timeout.php';

if (empty($_SESSION['login']) || !cek_login()) {
    $_SESSION['login'] = 0;
    header('Location: logout.php');
    exit;
}

$module = $_GET['module'] ?? 'home';
$foto = $_SESSION['foto'] ?: 'default-user.svg';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page - Sistem Penjualan</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body class="dashboard">
    <header class="topbar">
        <a href="media.php?module=home" class="brand">MASTER ADMIN</a>
        <button class="sidebar-toggle" type="button" aria-label="Buka menu" data-sidebar-toggle>☰</button>
        <div class="user-menu">
            <img src="../foto_banner/<?= e($foto) ?>" alt="Foto pengguna">
            <span><?= e($_SESSION['namalengkap']) ?></span>
            <a href="media.php?module=user&act=edit&id=<?= (int) $_SESSION['iduser'] ?>" class="btn btn-default btn-small">Profil</a>
            <a href="logout.php" class="btn btn-danger btn-small">Sign out</a>
        </div>
    </header>

    <div class="layout">
        <aside class="sidebar" data-sidebar>
            <div class="user-panel">
                <img src="../foto_banner/<?= e($foto) ?>" alt="Foto <?= e($_SESSION['namauser']) ?>">
                <div>
                    <strong><?= e($_SESSION['namauser']) ?></strong>
                    <small><span class="online-dot"></span> Online</small>
                </div>
            </div>
            <?php require __DIR__ . '/content-one.php'; ?>
        </aside>

        <main class="main-content">
            <?php require __DIR__ . '/content.php'; ?>
        </main>
    </div>

    <script src="js/app.js"></script>
</body>
</html>
