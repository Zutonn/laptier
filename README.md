# laptier
LapTier — Sistem Katalog, Tier List & Rekomendasi Laptop

LapTier adalah aplikasi web katalog, pemeringkatan (tier list), perbandingan, dan rekomendasi laptop berbasis PHP dan SQL. Website ini dirancang untuk membantu pengguna mencari, membandingkan, serta menentukan pilihan laptop sesuai kebutuhan melalui antarmuka publik yang dilengkapi dengan panel administrator untuk pengelolaan data produk secara dinamis.

Fitur Utama

1. Halaman Pengguna (Publik)
Beranda (index.php): Halaman utama yang menampilkan ringkasan informasi dan navigasi cepat menuju fitur-fitur utama website.
Katalog Laptop (katalog.php): Daftar koleksi laptop yang tersedia di dalam sistem lengkap dengan informasi dasar tiap unit.
Detail Produk (detail.php): Halaman informasi spesifikasi rinci untuk setiap unit laptop.
Tier List (tier-list.php): Pengelompokan dan pemeringkatan laptop berdasarkan tingkatan (tier) performa maupun kelasnya.
Bandingkan Laptop (bandingkan.php): Fitur komparasi untuk membandingkan spesifikasi beberapa laptop secara berdampingan.
Rekomendasi (rekomendasi.php): Halaman bantuan rekomendasi laptop yang disesuaikan dengan kebutuhan pengunjung.
Panduan (panduan.php): Informasi panduan bagi pengguna dalam memahami spesifikasi dan memilih laptop yang tepat.

2. Panel Administrator (admin/)
Autentikasi & Setup Awal (login.php, logout.php, auth.php, setup.php): Sistem login admin, proteksi sesi halaman, serta halaman inisialisasi akun awal.
Dashboard Admin (admin/index.php): Pusat kontrol dan ringkasan statistik pengelolaan data website.
Manajemen Data Laptop (laptops.php, laptop_form.php, laptop_delete.php): Fitur CRUD (Create, Read, Update, Delete) untuk menambah, memperbarui, menampilkan, dan menghapus data laptop beserta unggahan gambar produk ke direktori uploads/.
Manajemen Akun & Pengaturan (account.php, settings.php): Pengelolaan profil administrator dan konfigurasi umum website.

Teknologi & Keamanan
Backend: PHP native dengan arsitektur modular menggunakan folder includes/ (bootstrap.php, header.php, footer.php, functions.php, product-card.php).
Database: SQL dengan skema database pada database/laptier.sql dan konfigurasi koneksi terpusat di config/database.php.
Frontend: HTML, CSS (assets/css/style.css), JavaScript (assets/js/app.js), serta aset ikon vektor SVG (logo-mark.svg, laptop-placeholder.svg).
Keamanan Direktori: Dilengkapi konfigurasi .htaccess pada root serta direktori config/, database/, dan uploads/ untuk membatasi akses langsung ke file sensitif maupun eksekusi skrip yang tidak diinginkan.
Struktur Direktori

htdocs/
├── admin/                  # Modul panel administrator (login, CRUD laptop, pengaturan)
│   ├── _layout-top.php
│   ├── _layout-bottom.php
│   ├── account.php
│   ├── auth.php
│   ├── index.php
│   ├── laptop_delete.php
│   ├── laptop_form.php
│   ├── laptops.php
│   ├── login.php
│   ├── logout.php
│   ├── settings.php
│   └── setup.php
├── assets/                 # Aset statis tampilan (CSS, JS, gambar ikon)
│   ├── css/style.css
│   ├── images/
│   └── js/app.js
├── config/                 # Konfigurasi koneksi database
│   └── database.php
├── database/               # File skema & data awal SQL
│   └── laptier.sql
├── includes/               # Komponen tampilan & fungsi pembantu (reusable)
│   ├── bootstrap.php
│   ├── footer.php
│   ├── functions.php
│   ├── header.php
│   └── product-card.php
├── uploads/                # Penyimpanan foto/gambar unit laptop
├── index.php               # Halaman utama
├── katalog.php             # Halaman katalog laptop
├── detail.php              # Halaman detail laptop
├── tier-list.php           # Halaman tier list laptop
├── bandingkan.php          # Halaman perbandingan laptop
├── rekomendasi.php         # Halaman rekomendasi laptop
├── panduan.php             # Halaman panduan pengguna
├── MULAI_DI_SINI.txt       # Panduan cepat penggunaan awal
└── README.md               # Dokumentasi proyek


Cara Instalasi (Lokal)
Salin seluruh isi folder htdocs/ ke direktori root server web lokal Anda (seperti XAMPP, Laragon, atau WAMP).
Buat database baru melalui phpMyAdmin atau klien SQL, lalu impor file database/laptier.sql.
Sesuaikan pengaturan koneksi database (host, nama database, username, dan password) di dalam file config/database.php.
Jalankan layanan Apache dan MySQL, lalu akses proyek melalui browser (misalnya http://localhost/ atau sesuai nama folder proyek Anda).
Untuk masuk ke halaman pengelola, buka direktori /admin/ atau ikuti petunjuk tambahan pada file MULAI_DI_SINI.txt dan admin/setup.php.
