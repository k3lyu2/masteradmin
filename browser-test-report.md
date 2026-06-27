# Laporan Pengujian Browser Aplikasi Penjualan

## Lingkungan

- URL: `http://127.0.0.1/masteradmin/`
- Web server: Apache XAMPP
- Database: MariaDB `dbpenjualan`
- PHP: 8.0.30
- Alat uji: Playwright control browser
- Tanggal pengujian: 13 Juni 2026

## Persiapan

File `dbpenjualan.sql` berhasil diimpor. Data awal yang tersedia:

- 2 akun;
- 3 menu utama;
- 7 submenu;
- 2 pelanggan;
- 3 produk.

## Skenario yang Diuji

### Login Admin

- Login `admin / admin` berhasil.
- Pengguna diarahkan ke dashboard.
- Nama, foto, level, menu admin, profil, dan logout tampil.
- Dashboard menampilkan tanggal serta informasi pengguna.

Status: Lulus.

### CRUD Pelanggan

Data berikut berhasil ditambahkan melalui form browser:

- nama: Pelanggan Uji Playwright;
- tanggal lahir: 2000-01-15;
- jenis kelamin: P;
- email: `playwright@example.test`.

Notifikasi sukses dan data baru tampil pada tabel.

Status: Lulus.

### CRUD Produk

Data berikut berhasil ditambahkan:

- kode: `PW001`;
- nama: Produk Uji Playwright;
- harga: Rp 150.000.

Status: Lulus.

### Transaksi Admin

Transaksi `TRX-00001` berhasil dibuat untuk Pelanggan Uji Playwright. Produk `PW001`
ditambahkan sebanyak 2 dengan hasil:

- harga: Rp 150.000;
- subtotal: Rp 300.000;
- total: Rp 300.000.

Status: Lulus.

### Hak Akses User

Login `indah / indah` berhasil.

Hasil pemeriksaan:

- sidebar hanya menampilkan Dashboard dan Transaksi;
- akses langsung ke Menu Utama ditolak;
- user dapat membuat transaksi sendiri;
- transaksi user otomatis memakai petugas Indah Permata;
- user dapat menambah detail transaksi;
- tombol edit dan hapus detail tidak tampil;
- akses ke transaksi milik admin ditolak.

Status: Lulus.

### Login Gagal dan Logout

- Logout admin dan user berhasil.
- Login dengan akun salah ditolak.
- Pesan kesalahan tampil dengan benar.

Status: Lulus.

### Pemeriksaan Seluruh Halaman

Halaman berikut memberikan HTTP 200 dan judul konten yang benar:

1. Menu Utama
2. Sub Menu
3. Master User
4. Pelanggan
5. Produk
6. Penjualan
7. Penjualan Detail
8. Cetak Daftar Pelanggan

Status: Lulus.

### Console Browser

- Error JavaScript: 0
- Warning JavaScript: 0

Status: Lulus.

## Data Uji yang Tersimpan

Pengujian browser meninggalkan data berikut agar hasil dapat diperiksa manual:

- pelanggan `Pelanggan Uji Playwright`;
- produk `PW001 - Produk Uji Playwright`;
- transaksi admin `TRX-00001` senilai Rp 300.000;
- transaksi user `TRX-00002` senilai Rp 85.000.

## Bukti

- `artifacts/superpowers/browser-admin-dashboard.png`
- `artifacts/superpowers/browser-transaction-detail.png`

## Review

### Blocker

Tidak ada.

### Major

- MD5 dan aksi hapus melalui GET masih menjadi risiko keamanan. Keduanya dipertahankan agar
  pola aplikasi sesuai praktikum dan hanya layak digunakan secara lokal.

### Minor

- Pengujian otomatis berfokus pada tambah data dan pembatasan hak akses. Form edit dan tombol
  hapus sudah tampil pada akun admin, tetapi tidak dieksekusi agar bukti data transaksi tetap
  tersedia.

### Nit

- Tidak ada error console atau masalah tampilan yang ditemukan pada alur yang diuji.

## Kesimpulan

Aplikasi dapat dijalankan dan alur utama tugas berfungsi. Login, dashboard, seluruh halaman
modul, tambah pelanggan, tambah produk, transaksi, perhitungan total, cetak pelanggan,
logout, login gagal, dan pembagian hak akses telah diverifikasi melalui browser.

