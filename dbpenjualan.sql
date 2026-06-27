-- Database aplikasi penjualan sesuai Modul IV
CREATE DATABASE IF NOT EXISTS dbpenjualan
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE dbpenjualan;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS penjualandetail;
DROP TABLE IF EXISTS penjualan;
DROP TABLE IF EXISTS submenu;
DROP TABLE IF EXISTS menuutama;
DROP TABLE IF EXISTS produk;
DROP TABLE IF EXISTS pelanggan;
DROP TABLE IF EXISTS users;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users (
    id_users INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) DEFAULT NULL,
    no_telp VARCHAR(20) DEFAULT NULL,
    hakakses ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    blokir ENUM('Y', 'N') NOT NULL DEFAULT 'N',
    foto VARCHAR(100) DEFAULT 'default-user.svg',
    id_session VARCHAR(100) DEFAULT NULL
) ENGINE=InnoDB;

CREATE TABLE pelanggan (
    id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(50) NOT NULL,
    tgl_lahir DATE DEFAULT NULL,
    jk ENUM('L', 'P') DEFAULT NULL,
    agama VARCHAR(20) DEFAULT NULL,
    alamat TEXT DEFAULT NULL,
    telp VARCHAR(20) DEFAULT NULL,
    email VARCHAR(75) DEFAULT NULL
) ENGINE=InnoDB;

CREATE TABLE produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    kd_produk VARCHAR(10) NOT NULL UNIQUE,
    nama_produk VARCHAR(75) NOT NULL,
    harga INT UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB;

CREATE TABLE menuutama (
    id_main INT AUTO_INCREMENT PRIMARY KEY,
    nama_menu VARCHAR(50) NOT NULL,
    link VARCHAR(100) NOT NULL DEFAULT '#',
    aktif ENUM('Y', 'N') NOT NULL DEFAULT 'Y',
    hakakses ENUM('admin', 'user') NOT NULL DEFAULT 'admin',
    icon VARCHAR(50) NOT NULL DEFAULT 'fa fa-folder',
    urutan INT NOT NULL DEFAULT 0
) ENGINE=InnoDB;

CREATE TABLE submenu (
    id_sub INT AUTO_INCREMENT PRIMARY KEY,
    nama_sub VARCHAR(50) NOT NULL,
    link_sub VARCHAR(100) NOT NULL,
    id_main INT NOT NULL,
    aktif ENUM('Y', 'N') NOT NULL DEFAULT 'Y',
    urutan INT NOT NULL DEFAULT 0,
    CONSTRAINT fk_submenu_menuutama
        FOREIGN KEY (id_main) REFERENCES menuutama(id_main)
        ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE penjualan (
    id_penjualan INT AUTO_INCREMENT PRIMARY KEY,
    tgl_penjualan DATE NOT NULL,
    id_pelanggan INT NOT NULL,
    id_users INT NOT NULL,
    CONSTRAINT fk_penjualan_pelanggan
        FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_penjualan_users
        FOREIGN KEY (id_users) REFERENCES users(id_users)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE penjualandetail (
    id_penjualandetail INT AUTO_INCREMENT PRIMARY KEY,
    id_penjualan INT NOT NULL,
    kd_produk VARCHAR(10) NOT NULL,
    harga INT UNSIGNED NOT NULL,
    qty INT UNSIGNED NOT NULL DEFAULT 1,
    CONSTRAINT fk_detail_penjualan
        FOREIGN KEY (id_penjualan) REFERENCES penjualan(id_penjualan)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_detail_produk
        FOREIGN KEY (kd_produk) REFERENCES produk(kd_produk)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Password contoh mengikuti praktikum, yaitu MD5.
INSERT INTO users
    (username, password, nama_lengkap, email, no_telp, hakakses, blokir, foto)
VALUES
    ('admin', MD5('admin'), 'Administrator', 'admin@example.test', '081234567890', 'admin', 'N', 'default-user.svg'),
    ('indah', MD5('indah'), 'Indah Permata', 'indah@example.test', '081234567891', 'user', 'N', 'default-user.svg');

INSERT INTO menuutama (nama_menu, link, aktif, hakakses, icon, urutan) VALUES
    ('Pengaturan', '#', 'Y', 'admin', 'fa fa-cogs', 1),
    ('Data Master', '#', 'Y', 'admin', 'fa fa-database', 2),
    ('Transaksi', '#', 'Y', 'user', 'fa fa-shopping-cart', 3);

INSERT INTO submenu
    (nama_sub, link_sub, id_main, aktif, urutan)
VALUES
    ('Menu Utama', '?module=menuutama', 1, 'Y', 1),
    ('Sub Menu', '?module=submenu', 1, 'Y', 2),
    ('User', '?module=user', 2, 'Y', 1),
    ('Pelanggan', '?module=pelanggan', 2, 'Y', 2),
    ('Produk', '?module=produk', 2, 'Y', 3),
    ('Penjualan', '?module=penjualan', 3, 'Y', 1),
    ('Penjualan Detail', '?module=penjualandetail', 3, 'Y', 2);

INSERT INTO pelanggan
    (nama_pelanggan, tgl_lahir, jk, agama, alamat, telp, email)
VALUES
    ('Budi Santoso', '1995-03-15', 'L', 'Islam', 'Bekasi', '081111111111', 'budi@example.test'),
    ('Siti Aminah', '1998-08-20', 'P', 'Islam', 'Jakarta', '082222222222', 'siti@example.test');

INSERT INTO produk (kd_produk, nama_produk, harga) VALUES
    ('PRD001', 'Buku Pemrograman Web', 85000),
    ('PRD002', 'Keyboard USB', 125000),
    ('PRD003', 'Mouse Optik', 75000);
