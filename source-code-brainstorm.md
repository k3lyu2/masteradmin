# Brainstorm Source Code Praktikum

## Tujuan

Membangun source code aplikasi `masteradmin` berdasarkan `modul.md` dan
`dbpenjualan.sql`, kemudian pada tahap berikutnya menjalankan serta menguji seluruh alur
aplikasi melalui browser.

## Kondisi Awal

Workspace saat ini hanya mempunyai:

- `modul.md`;
- `dbpenjualan.sql`;
- PDF sumber;
- artefak dokumentasi.

Belum ada source PHP, CSS, JavaScript, gambar, maupun folder modul aplikasi.

## Batasan Kesesuaian Modul

Kode yang tertulis cukup lengkap di materi:

- login;
- halaman utama;
- controller konten;
- sidebar;
- submenu;
- user;
- pelanggan;
- cetak pelanggan.

Materi hanya memberikan deskripsi dan gambar untuk:

- menu utama;
- produk;
- penjualan;
- detail penjualan.

Empat bagian tersebut harus direkonstruksi dengan pola procedural PHP/MySQLi dan bentuk CRUD
yang sama dengan modul lain. Rekonstruksi tidak boleh menambahkan fitur di luar materi.

## Ketidakkonsistenan Materi

1. Rancangan menyebut database `dbpenjualan`, tetapi contoh koneksi dan petunjuk instalasi
   menyebut `masteradmin`.
2. Beberapa file utama menggunakan `../config/koneksi.php`, padahal struktur yang dijelaskan
   menempatkan `config` di dalam folder utama.
3. Session login mengisi `namauser`, tetapi beberapa pemeriksaan mencari `username`.
4. Materi kadang membaca kolom `level`, sedangkan SQL memakai `hakakses`.
5. Materi mengandalkan aset AdminLTE lama yang tidak disertakan.
6. SQL hanya menyediakan admin, sedangkan petunjuk juga menyebut akun user `indah`.

## Keputusan Implementasi

- Gunakan database `dbpenjualan` agar sesuai nama rancangan dan file SQL yang tersedia.
- Pertahankan nama folder proyek `masteradmin`.
- Gunakan path relatif yang benar untuk struktur aktual.
- Pertahankan nama session dan kolom secara konsisten dengan SQL.
- Pertahankan tampilan bergaya AdminLTE 2/Bootstrap 3, tetapi sediakan aset lokal yang
  diperlukan agar aplikasi tidak bergantung pada CDN.
- Pertahankan MD5 karena pengguna meminta hasil sesuai praktikum, dengan catatan bahwa ini
  hanya layak untuk tugas pembelajaran lokal.
- Gunakan prepared statement dan validasi pada titik input bila tidak mengubah perilaku serta
  tampilan tugas.
- Tambahkan komentar bahasa Indonesia yang menjelaskan tujuan blok kode, bukan mengomentari
  setiap baris secara berlebihan.

## Struktur Target

```text
masteradmin/
|-- admin@web/
|   |-- modul/
|   |   |-- mod_menuutama/
|   |   |-- mod_submenu/
|   |   |-- mod_users/
|   |   |-- mod_pelanggan/
|   |   |-- mod_produk/
|   |   |-- mod_penjualan/
|   |   `-- mod_penjualandetail/
|   |-- cek_login.php
|   |-- content-one.php
|   |-- content.php
|   |-- error-login.php
|   |-- index.php
|   |-- logout.php
|   |-- media.php
|   `-- timeout.php
|-- config/
|   |-- fungsi_indotgl.php
|   |-- fungsi_thumb.php
|   |-- koneksi.php
|   `-- library.php
|-- css/
|-- js/
|-- img/
|-- foto_banner/
|-- dbpenjualan.sql
|-- index.php
`-- modul.md
```

Root `index.php` akan mengarahkan pengguna ke halaman login di `admin@web`, sedangkan file
fitur tetap mengikuti pembagian folder dalam praktikum.

## Risiko

- PHP versi baru dapat menolak sintaks array tanpa tanda kutip yang dipakai materi lama.
- Ekstensi `mysqli` atau layanan MySQL XAMPP mungkin belum aktif.
- Port Apache/MySQL dapat berbeda dari konfigurasi standar.
- Foreign key dapat menghalangi penghapusan data yang sudah dipakai transaksi.
- Pengujian browser membutuhkan database sudah berhasil diimpor.

## Kriteria Penerimaan

1. Struktur folder dan tujuh modul tersedia.
2. SQL dapat diimpor tanpa error dan mempunyai akun admin serta user.
3. Login admin dan user berfungsi.
4. Session timeout dan logout berfungsi.
5. Sidebar berbeda sesuai hak akses.
6. CRUD menu utama, submenu, user, pelanggan, dan produk berfungsi.
7. Transaksi penjualan dan detail barang dapat ditambahkan.
8. Admin dapat mengubah/menghapus transaksi sesuai aturan relasi.
9. User tidak dapat mengubah atau menghapus transaksi.
10. Cetak pelanggan dapat dibuka.
11. Tidak ada fatal error PHP atau error JavaScript pada alur utama.
12. Komentar kode menggunakan bahasa Indonesia yang mudah dipahami.

