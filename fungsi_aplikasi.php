<?php
/**
 * Mengamankan teks sebelum ditampilkan ke HTML.
 */
function e(?string $nilai): string
{
    return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8');
}

function rupiah(int|float|string $nilai): string
{
    return 'Rp ' . number_format((float) $nilai, 0, ',', '.');
}

function wajib_admin(): void
{
    if (($_SESSION['leveluser'] ?? '') !== 'admin') {
        set_pesan('danger', 'Halaman ini hanya dapat diakses oleh admin.');
        header('Location: ../../media.php?module=home');
        exit;
    }
}

function set_pesan(string $jenis, string $isi): void
{
    $_SESSION['notifikasi'] = ['jenis' => $jenis, 'isi' => $isi];
}

function tampilkan_pesan(): void
{
    if (empty($_SESSION['notifikasi'])) {
        return;
    }

    $pesan = $_SESSION['notifikasi'];
    unset($_SESSION['notifikasi']);
    echo '<div class="alert alert-' . e($pesan['jenis']) . '">' . e($pesan['isi']) . '</div>';
}

function arahkan(string $module): never
{
    header('Location: ../../media.php?module=' . rawurlencode($module));
    exit;
}

function ambil_int(string $sumber, string $nama): int
{
    $data = $sumber === 'get' ? $_GET : $_POST;
    return filter_var($data[$nama] ?? 0, FILTER_VALIDATE_INT) ?: 0;
}

