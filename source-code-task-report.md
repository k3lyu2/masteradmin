# Task Report - Source Code Aplikasi Penjualan

## Status

Source code aplikasi penjualan berdasarkan Modul IV telah selesai dibuat.

Pengujian browser belum dilakukan pada tahap ini karena pengguna meminta source code dibuat
terlebih dahulu.

## Source yang Dibuat

### Fondasi

- root redirect `index.php`;
- koneksi MariaDB/MySQLi;
- helper aplikasi, tanggal, upload foto, dan session timeout;
- CSS dashboard lokal;
- JavaScript sidebar dan konfirmasi;
- gambar user bawaan.

### Autentikasi

- login admin dan user;
- pemeriksaan akun terblokir;
- pembuatan session;
- pembaruan ID session;
- logout;
- session timeout 30 menit.

### Dashboard

- header dan profil user;
- sidebar berbasis database;
- menu berdasarkan hak akses;
- controller modul melalui `content.php`;
- dashboard utama.

### Tujuh Modul

1. `mod_menuutama`
2. `mod_submenu`
3. `mod_users`
4. `mod_pelanggan`
5. `mod_produk`
6. `mod_penjualan`
7. `mod_penjualandetail`

Setiap modul mempunyai file aksi terpisah. Modul pelanggan juga mempunyai halaman cetak,
sedangkan modul user mempunyai komponen formulir bersama.

## Penyesuaian dari Materi

- Database memakai `dbpenjualan`, sesuai rancangan dan nama file SQL.
- Path `config` diperbaiki agar sesuai struktur folder aktual.
- Session memakai `namauser` dan `leveluser` secara konsisten.
- Kolom hak akses memakai `hakakses`, sesuai SQL.
- Hak akses submenu diwarisi dari `menuutama`.
- Sintaks disesuaikan agar berjalan di PHP 8.0.
- Query input memakai prepared statement tanpa mengubah fungsi tugas.
- Tampilan dibuat lokal agar tidak bergantung pada CDN atau unduhan AdminLTE.

## Verifikasi yang Dijalankan

### PHP lint

```powershell
Get-ChildItem -Recurse -Filter *.php |
    ForEach-Object { C:\xampp\php\php.exe -l $_.FullName }
```

Hasil:

- 30 file PHP diperiksa;
- seluruh file lulus;
- tidak ditemukan syntax error.

### Koneksi database

```powershell
C:\xampp\php\php.exe -r "require 'config/koneksi.php'; ..."
```

Hasil:

- koneksi PHP ke MariaDB berhasil;
- ekstensi `mysqli` aktif;
- ekstensi `fileinfo` aktif;
- ketujuh tabel dapat dibaca.

### Struktur

Hasil:

- 7 folder modul tersedia;
- 7 file aksi tersedia;
- CSS, JavaScript, SQL, dan gambar bawaan tersedia;
- tidak ada `TODO`, stub, atau marker `CONTINUE_HERE`.

## Kondisi Database Lokal

Database `dbpenjualan` sudah ada dan mempunyai ketujuh tabel, tetapi seluruh tabel masih
kosong. File `dbpenjualan.sql` sudah berisi skema dan data awal:

- admin: `admin / admin`;
- user: `indah / indah`;
- menu dan submenu;
- dua pelanggan;
- tiga produk.

File SQL belum diimpor ulang karena proses tersebut menghapus tabel lama sebelum membuat
ulang skema. Impor akan dilakukan saat tahap pengujian browser setelah pengguna
memerintahkan pengujian.

## Review

### Blocker

- Tidak ada blocker pada source code.
- Aplikasi belum bisa login sebelum `dbpenjualan.sql` diimpor karena tabel lokal masih kosong.

### Major

- Password MD5 dipertahankan agar sesuai praktikum. MD5 tidak boleh digunakan untuk aplikasi
  produksi.
- Aksi hapus mengikuti pola praktikum berbasis tautan GET dan belum memakai CSRF token.
  Aplikasi hanya ditujukan untuk tugas lokal.

### Minor

- Tampilan mengikuti pola dashboard AdminLTE, tetapi aset dibuat ulang secara lokal karena
  paket AdminLTE asli tidak tersedia dalam materi.
- Modul produk, penjualan, dan detail direkonstruksi dari gambar, deskripsi, dan pola CRUD
  modul lain karena kode lengkapnya tidak dicantumkan.

### Nit

- Icon menggunakan simbol lokal sederhana agar tidak membutuhkan pustaka font eksternal.

## Large File Protocol

Tidak ada satu file source yang perlu dipecah dengan marker `CONTINUE_HERE`. Implementasi
ditulis dalam lima batch perubahan berurutan, dan seluruh struktur sudah ditutup lengkap tanpa
stub.

## Tahap Berikutnya

Tahap pengujian browser mencakup:

1. backup atau persetujuan impor ulang database;
2. impor `dbpenjualan.sql`;
3. pengujian login admin dan user;
4. pengujian seluruh CRUD;
5. pengujian transaksi dan total;
6. pemeriksaan console browser serta tampilan;
7. perbaikan masalah yang ditemukan.

