<?php
// Konfigurasi koneksi database lokal XAMPP.
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'dbpenjualan';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $koneksi = mysqli_connect($server, $username, $password, $database);
    mysqli_set_charset($koneksi, 'utf8mb4');
} catch (mysqli_sql_exception $error) {
    die('Database tidak bisa dibuka. Pastikan MySQL aktif dan database sudah diimpor.');
}
