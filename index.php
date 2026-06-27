<?php
session_start();

if (!empty($_SESSION['login'])) {
    header('Location: media.php?module=home');
    exit;
}

$pesan = $_SESSION['pesan_login'] ?? '';
unset($_SESSION['pesan_login']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Administrator</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body class="login-page">
    <main class="login-box">
        <div class="login-logo">SISTEM PENJUALAN</div>
        <div class="login-card">
            <div class="login-header">Login</div>

            <?php if ($pesan !== ''): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($pesan) ?></div>
            <?php endif; ?>

            <form id="form-login" method="post" action="cek_login.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" class="form-control"
                           placeholder="Masukkan username" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" class="form-control"
                           placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn btn-success btn-block">Sign me in</button>
            </form>

            <div class="login-help">
                Admin: <strong>admin / admin</strong><br>
                User: <strong>indah / indah</strong>
            </div>
        </div>
    </main>
</body>
</html>

