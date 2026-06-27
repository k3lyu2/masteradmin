# Penjelasan Praktikum Aplikasi Penjualan

## Tujuan

Praktikum pada PDF ini mengajarkan pembuatan aplikasi administrasi penjualan berbasis web
menggunakan PHP, MySQL/MySQLi, HTML, CSS, JavaScript, dan XAMPP.

Hasil akhirnya adalah aplikasi `masteradmin` yang mempunyai:

- halaman login;
- dashboard dengan menu dinamis;
- pengelolaan pengguna;
- pengelolaan pelanggan dan produk;
- pencatatan transaksi penjualan;
- detail barang dalam transaksi;
- pembagian hak akses admin dan user;
- fasilitas cetak daftar pelanggan.

## Alur Praktikum

### 1. Merancang database

Database penjualan berisi tujuh tabel:

1. `menuutama`
2. `submenu`
3. `users`
4. `pelanggan`
5. `produk`
6. `penjualan`
7. `penjualandetail`

Tabel master menyimpan pengguna, pelanggan, produk, dan konfigurasi menu. Tabel
`penjualan` menjadi kepala transaksi, sedangkan `penjualandetail` menyimpan item-item produk
yang ada dalam setiap transaksi.

### 2. Menyiapkan struktur aplikasi

Proyek ditempatkan di `C:\xampp\htdocs\masteradmin`. Kode administrasi disusun dalam
folder `admin@web`, kemudian setiap fitur ditempatkan dalam folder modul masing-masing,
misalnya:

- `mod_menuutama`
- `mod_submenu`
- `mod_pelanggan`
- `mod_produk`
- `mod_penjualan`
- `mod_penjualandetail`
- `mod_users`

Struktur tersebut melatih pemisahan kode berdasarkan fitur, walaupun belum menggunakan
framework atau arsitektur MVC formal.

### 3. Membuat autentikasi

Bagian login memakai:

- `config/koneksi.php` untuk koneksi ke MySQL;
- `index.php` untuk formulir login;
- `cek_login.php` untuk memeriksa username dan password serta membuat session.

Session digunakan untuk mencegah pengguna yang belum login membuka modul admin secara
langsung.

### 4. Membuat dashboard

`media.php` menjadi kerangka halaman admin. File ini memuat bagian antarmuka seperti header,
sidebar, konten, dan aset dashboard.

`content.php` berfungsi sebagai pengarah modul. Nilai parameter `module` dari URL menentukan
file fitur yang ditampilkan.

`content-one.php` membentuk menu samping berdasarkan data menu dan hak akses pengguna.

### 5. Mengelola menu aplikasi

Admin dapat melakukan operasi tambah, tampil, ubah, dan hapus pada:

- menu utama;
- submenu;
- urutan menu;
- tautan submenu menuju modul tertentu.

Menu disimpan dalam database sehingga navigasi dashboard dapat diubah tanpa menulis ulang
seluruh sidebar.

### 6. Mengelola pengguna

Modul user memungkinkan admin:

- menambah akun;
- mengubah profil;
- menghapus akun;
- mengatur status blokir;
- mengunggah foto;
- menyimpan password;
- menentukan data kontak pengguna.

Contoh dalam modul masih memakai hash MD5. Untuk aplikasi baru, implementasi tersebut harus
diganti dengan `password_hash()` dan `password_verify()`.

### 7. Mengelola pelanggan

Modul pelanggan menyediakan operasi CRUD untuk data:

- nama pelanggan;
- tanggal lahir;
- jenis kelamin;
- agama;
- alamat;
- nomor telepon;
- email.

Terdapat pula `cetak.php` untuk membuat tampilan daftar pelanggan yang dapat dicetak.

### 8. Mengelola produk

Modul produk dipakai untuk menambah, mengubah, melihat, dan menghapus data produk.
PDF hanya memberikan penjelasan singkat dan gambar hasil halaman pada bagian ini; kode
lengkap disediakan melalui paket source code terpisah.

### 9. Mengelola transaksi penjualan

Modul penjualan menyimpan informasi utama transaksi. Hak aksesnya dibedakan:

- admin dapat menambah, mengubah, dan menghapus transaksi;
- user biasa hanya dapat menambahkan transaksi.

### 10. Mengelola detail penjualan

Modul detail penjualan menyimpan daftar produk dalam suatu transaksi. Secara konsep,
hubungannya adalah satu data `penjualan` dapat mempunyai banyak baris
`penjualandetail`.

### 11. Menjalankan aplikasi

Urutan menjalankan aplikasi menurut modul:

1. Instal XAMPP.
2. Letakkan aplikasi di `xampp/htdocs`.
3. Aktifkan Apache dan MySQL.
4. Buat database `masteradmin`.
5. Impor file SQL aplikasi.
6. Buka `http://localhost/masteradmin`.
7. Login sebagai admin atau user.

### 12. Mengembangkan modul baru

Modul menjelaskan cara menambah fitur dengan:

1. menambahkan pemetaan modul pada `content.php`;
2. menyalin folder modul yang sudah ada;
3. mengganti nama folder, file, tabel, dan atribut;
4. menyesuaikan kode CRUD;
5. mendaftarkan modul baru melalui menu pengelolaan submenu.

## Hasil Belajar

Setelah menyelesaikan praktikum, peserta diharapkan memahami:

- koneksi PHP ke MySQL;
- session dan autentikasi;
- operasi CRUD dengan MySQLi;
- pemrosesan formulir dan parameter URL;
- unggah gambar;
- pembagian hak akses;
- relasi transaksi dan detail transaksi;
- navigasi berbasis database;
- penyusunan aplikasi PHP modular.

## Catatan Teknis

Materi menggunakan pola PHP lama dan cocok untuk memahami dasar, tetapi belum aman untuk
langsung digunakan sebagai aplikasi produksi. Beberapa bagian perlu dimodernisasi:

- query menerima input langsung sehingga rentan SQL injection;
- password menggunakan MD5;
- validasi dan escaping keluaran masih terbatas;
- aksi perubahan data menggunakan parameter URL tanpa perlindungan CSRF;
- unggahan file memerlukan validasi tipe, ukuran, dan nama file yang lebih ketat;
- kredensial contoh tidak boleh digunakan pada sistem nyata.

## Review

- Blocker: tidak ada untuk tujuan pembelajaran lokal.
- Major: query langsung dan MD5 tidak layak digunakan pada lingkungan produksi.
- Minor: terdapat beberapa salah ketik dan ketidakkonsistenan nama database dalam materi.
- Nit: bagian produk, penjualan, dan detail penjualan lebih banyak menampilkan hasil daripada
  uraian kode lengkap.

## Kesimpulan

Praktikum ini adalah latihan membuat aplikasi CRUD penjualan dengan dashboard admin, login,
menu dinamis, hak akses, data master, dan transaksi. Fokus utamanya adalah memahami alur
aplikasi PHP-MySQL dari database sampai antarmuka, bukan membangun sistem produksi yang
sudah memenuhi standar keamanan modern.
