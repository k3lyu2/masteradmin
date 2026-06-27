<?php
// File ini bertindak sebagai controller sederhana untuk memilih modul yang ditampilkan.
if ($module === 'home') {
    ?>
    <section class="content-header">
        <h1>Dashboard</h1>
        <p>Selamat datang, <strong><?= e($_SESSION['namalengkap']) ?></strong>.</p>
    </section>

    <section class="content-card hero">
        <div>
            <span class="eyebrow"><?= e(tgl_indo(date('Y-m-d'))) ?></span>
            <h2>SISTEM PENJUALAN</h2>
            <p>
                Kelola data master dan transaksi penjualan melalui menu di sebelah kiri.
                Anda masuk sebagai <strong><?= e($_SESSION['leveluser']) ?></strong>.
            </p>
        </div>
        <div class="hero-icon">▤</div>
    </section>
    <?php
    return;
}

$daftarModul = [
    'menuutama' => 'modul/mod_menuutama/menuutama.php',
    'submenu' => 'modul/mod_submenu/submenu.php',
    'user' => 'modul/mod_users/users.php',
    'pelanggan' => 'modul/mod_pelanggan/pelanggan.php',
    'produk' => 'modul/mod_produk/produk.php',
    'penjualan' => 'modul/mod_penjualan/penjualan.php',
    'penjualandetail' => 'modul/mod_penjualandetail/penjualandetail.php',
];

if (!isset($daftarModul[$module])) {
    echo '<div class="alert alert-danger">Halaman tidak ditemukan.</div>';
    echo '<a class="btn btn-primary" href="media.php?module=home">Kembali ke Dashboard</a>';
    return;
}

require __DIR__ . '/' . $daftarModul[$module];

