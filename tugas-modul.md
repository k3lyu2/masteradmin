# Tugas pada Modul IV Aplikasi Penjualan

## Kesimpulan

`modul.md` tidak mempunyai bagian khusus berjudul **Tugas** atau **Latihan**. Tugasnya
tersirat dari seluruh langkah praktikum, yaitu membuat dan menjalankan aplikasi penjualan
berbasis PHP dan MySQL dengan nama folder `masteradmin`.

## Hasil yang Harus Dibuat

1. Database penjualan dengan tujuh tabel:
   - `menuutama`
   - `submenu`
   - `users`
   - `pelanggan`
   - `produk`
   - `penjualan`
   - `penjualandetail`
2. Struktur folder aplikasi sesuai modul.
3. Halaman login dengan session.
4. Dashboard admin dengan menu dan submenu dinamis.
5. Modul CRUD Menu Utama.
6. Modul CRUD Sub Menu.
7. Modul CRUD User.
8. Modul CRUD Pelanggan dan halaman cetak.
9. Modul CRUD Produk.
10. Modul transaksi Penjualan.
11. Modul Penjualan Detail.
12. Pembagian hak akses:
    - admin dapat mengelola seluruh data;
    - user dapat menambah transaksi, tetapi tidak mengubah atau menghapus transaksi.

## Cara Menjalankan

1. Letakkan aplikasi di `C:\xampp\htdocs\masteradmin`.
2. Aktifkan Apache dan MySQL.
3. Buat atau impor database aplikasi.
4. Buka `http://localhost/masteradmin`.
5. Login sebagai admin atau user.
6. Demonstrasikan operasi CRUD dan transaksi.

## Kemungkinan Bentuk Pengumpulan

Karena format pengumpulan tidak dijelaskan dalam modul, hasil yang paling masuk akal untuk
disiapkan adalah:

- folder source code `masteradmin`;
- file database `dbpenjualan.sql`;
- bukti aplikasi dapat dijalankan;
- bukti login admin dan user;
- bukti CRUD data master;
- bukti transaksi beserta detail dan total;
- penjelasan singkat struktur database dan hak akses.

## Status Implementasi

Seluruh bagian utama di atas sudah dibuat dan diuji melalui browser. Bukti pengujian tersedia
di `artifacts/superpowers/browser-test-report.md`.

