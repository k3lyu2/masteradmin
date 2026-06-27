# Rencana Implementasi Source Code Praktikum

## Tahap 1 - Fondasi Aplikasi

1. Membuat struktur folder sesuai praktikum.
2. Menyelaraskan `dbpenjualan.sql` dengan kebutuhan modul dan data contoh.
3. Membuat konfigurasi koneksi, library tanggal, timeout, upload gambar, dan bootstrap aplikasi.
4. Menyediakan aset tampilan lokal yang diperlukan.

Verifikasi:

```powershell
Get-ChildItem -Recurse
php -l config\koneksi.php
```

## Tahap 2 - Login dan Halaman Utama

1. Membuat halaman login.
2. Membuat pemeriksaan kredensial serta session.
3. Membuat logout dan penanganan login gagal.
4. Membuat `media.php`, `content.php`, dan `content-one.php`.
5. Menampilkan sidebar berdasarkan hak akses.

Verifikasi:

- lint seluruh file PHP;
- login admin berhasil;
- login salah ditolak;
- halaman tanpa session diarahkan ke login;
- logout menghapus session.

## Tahap 3 - Modul Konfigurasi

1. Membuat CRUD menu utama.
2. Membuat CRUD submenu.
3. Membatasi keduanya hanya untuk admin.
4. Memastikan menu baru muncul menurut urutan dan status aktif.

Verifikasi:

- tambah, ubah, dan hapus menu;
- tambah, ubah, dan hapus submenu;
- perubahan tampil pada sidebar.

## Tahap 4 - Modul Data Master

1. Membuat CRUD user dan upload foto.
2. Membuat CRUD pelanggan.
3. Membuat halaman cetak pelanggan.
4. Membuat CRUD produk.
5. Menerapkan validasi formulir dan pesan hasil operasi.

Verifikasi:

- operasi CRUD setiap tabel;
- validasi data wajib;
- unggahan gambar valid dan penolakan file tidak valid;
- halaman cetak dapat dimuat.

## Tahap 5 - Modul Transaksi

1. Membuat daftar dan formulir transaksi penjualan.
2. Menghubungkan transaksi dengan pelanggan dan user.
3. Membuat detail penjualan berdasarkan produk, harga, dan kuantitas.
4. Menghitung subtotal serta total transaksi.
5. Menerapkan aturan admin dan user dari praktikum.

Verifikasi:

- transaksi dapat dibuat;
- beberapa detail dapat ditambahkan;
- total sesuai harga dikali kuantitas;
- admin dapat mengelola transaksi;
- user hanya dapat menambahkan transaksi.

## Tahap 6 - Pemeriksaan Source

1. Menjalankan `php -l` untuk seluruh file PHP.
2. Memeriksa query dan nama kolom terhadap skema SQL.
3. Memeriksa path include, aset, tautan, dan action formulir.
4. Melakukan review keamanan dan konsistensi komentar.

Perintah utama:

```powershell
Get-ChildItem -Recurse -Filter *.php |
    ForEach-Object { php -l $_.FullName }
```

## Tahap 7 - Pengujian Browser

Tahap ini dilakukan setelah source selesai, sesuai permintaan pengguna.

1. Memastikan Apache dan MySQL berjalan.
2. Mengimpor ulang database uji.
3. Membuka `http://localhost/masteradmin`.
4. Menguji login admin dan user.
5. Menguji seluruh CRUD dan transaksi.
6. Memeriksa tampilan desktop, console browser, dan respons server.
7. Mencatat hasil, bukti pengujian, dan masalah yang ditemukan.

## Tahap 8 - Review dan Laporan

1. Melakukan review dengan kategori Blocker, Major, Minor, dan Nit.
2. Memperbaiki masalah yang ditemukan.
3. Mengulangi lint serta pengujian relevan.
4. Menyimpan laporan penyelesaian di `artifacts/superpowers/`.

## Urutan Eksekusi yang Disepakati

Permintaan saat ini diprioritaskan sebagai berikut:

1. membuat source code lengkap terlebih dahulu;
2. melakukan lint dan pemeriksaan struktur;
3. setelah itu menjalankan pengujian browser menyeluruh.

