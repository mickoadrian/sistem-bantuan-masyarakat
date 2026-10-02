Sistem Informasi Bantuan Masyarakat

Sistem Informasi Bantuan Masyarakat merupakan aplikasi berbasis web yang dibuat untuk membantu proses pendataan masyarakat dan penerima bantuan. Aplikasi ini dibuat menggunakan PHP dan MySQL serta dijalankan menggunakan XAMPP pada tahap pengembangan.

Project ini dibuat sebagai bagian dari pembelajaran dan pengembangan aplikasi berbasis web.

Fitur

Login administrator

Pengelolaan data penduduk

Menambahkan data penduduk

Mengubah data penduduk

Pengelolaan data penerima bantuan

Menampilkan data bantuan

Pembuatan laporan

Cetak laporan dalam format PDF

Teknologi

PHP

MySQL

HTML

CSS

JavaScript

Bootstrap

FPDF

XAMPP

Git

Struktur Project

Beberapa file dan folder utama dalam project ini:

sistem-bantuan-masyarakat/
├── assets/
├── fpdf/
├── administrator.php
├── index.php
├── login.php
├── logout.php
├── koneksi.php
├── penduduk.php
├── tambahpenduduk.php
├── editpenduduk.php
├── penerimabantuan.php
├── laporan.php
├── cetaklaporan1.php
├── bansos.sql
└── README.md

Menjalankan Project

Project ini menggunakan XAMPP sebagai local server.

1. Menempatkan Project

Salin folder project ke dalam:

C:\xampp\htdocs\


Contohnya:

C:\xampp\htdocs\sistem-bantuan-masyarakat fiks

2. Menjalankan XAMPP

Buka XAMPP Control Panel kemudian jalankan:

Apache

MySQL

3. Membuat Database

Buka phpMyAdmin melalui:

http://localhost/phpmyadmin


Buat database dengan nama:

bansos


Kemudian import file:

bansos.sql

4. Mengecek Koneksi Database

Konfigurasi database terdapat pada file:

koneksi.php


Konfigurasi yang digunakan pada pengembangan lokal:

$host = "localhost";
$user = "root";
$password = "";
$database = "bansos";

5. Membuka Aplikasi

Setelah Apache dan MySQL aktif, buka browser dan akses:

http://localhost/sistem-bantuan-masyarakat%20fiks/

Database

File bansos.sql disertakan dalam repository untuk memudahkan proses setup database pada lingkungan pengembangan.

Data yang terdapat di dalam database repository merupakan data dummy yang digunakan untuk kebutuhan pengujian aplikasi.

Pengembangan

Beberapa hal yang masih dapat dikembangkan dari aplikasi ini antara lain:

Perbaikan keamanan autentikasi

Validasi input yang lebih lengkap

Pengaturan hak akses pengguna

Peningkatan tampilan dashboard

Pencarian dan filter data

Pengembangan fitur laporan

Author

Micko Adrian

GitHub:
https://github.com/mickoadrian# 