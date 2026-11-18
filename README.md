# 💻 LapTier — Katalog, Tier List & Rekomendasi Laptop

![PHP](https://img.shields.io/badge/PHP-Native-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

**LapTier** adalah aplikasi web berbasis PHP dan SQL yang dirancang untuk membantu pengguna mencari, membandingkan, dan memilih laptop sesuai kebutuhan. Dilengkapi dengan fitur pemeringkatan (*tier list*), perbandingan spesifikasi berdampingan, halaman rekomendasi, serta panel administrator untuk pengelolaan data produk secara dinamis.

🌐 **Live Demo:** [Kunjungi Website LapTier](https://link-hosting-anda.com)

---

## 📸 Tampilan Aplikasi

| Halaman Beranda & Katalog | Halaman Tier List & Perbandingan |
| :<img width="1595" height="3064" alt="laptier gt tc_index php" src="https://github.com/user-attachments/assets/2f144c83-5565-4be7-8b2a-b2af77582a16" />: | :<img width="1595" height="1730" alt="laptier gt tc_tier-list php" src="https://github.com/user-attachments/assets/cf6d3dd4-7741-4d1f-afdf-f56d5caf03c7" />
: |
| *Tarik & lepas screenshot beranda di sini* | *Tarik & lepas screenshot tier list di sini* |

| Halaman Rekomendasi | Dashboard Admin |
| :---: | :---: |
| *Tarik & lepas screenshot rekomendasi di sini* | *Tarik & lepas screenshot panel admin di sini* |

---

## ✨ Fitur Utama

### 🌐 Halaman Publik (Pengunjung)
* **Beranda (`index.php`)** — Ringkasan informasi dan akses cepat ke seluruh fitur utama.
* **Katalog Laptop (`katalog.php`)** — Daftar koleksi laptop yang tersedia.
* **Detail Produk (`detail.php`)** — Informasi spesifikasi lengkap untuk setiap unit laptop.
* **Tier List (`tier-list.php`)** — Pengelompokan dan pemeringkatan laptop berdasarkan tingkatan (*tier*).
* **Bandingkan Laptop (`bandingkan.php`)** — Komparasi spesifikasi antar-unit laptop secara berdampingan.
* **Rekomendasi (`rekomendasi.php`)** — Bantuan pemilihan laptop yang disesuaikan dengan kebutuhan pengguna.
* **Panduan (`panduan.php`)** — Edukasi dan panduan dasar dalam memilih spesifikasi laptop.

### 🔐 Panel Administrator (`admin/`)
* **Autentikasi & Setup (`login.php`, `logout.php`, `auth.php`, `setup.php`)** — Sistem login admin, proteksi sesi, dan inisialisasi akun awal.
* **Dashboard Admin (`admin/index.php`)** — Ringkasan data dan pusat kontrol pengelolaan konten.
* **Manajemen Data Laptop (`laptops.php`, `laptop_form.php`, `laptop_delete.php`)** — Operasi CRUD (Tambah, Lihat, Ubah, Hapus) data laptop beserta unggah gambar produk.
* **Akun & Pengaturan (`account.php`, `settings.php`)** — Pengelolaan profil admin dan konfigurasi umum website.

---

## 🛠️ Teknologi & Struktur Proyek

* **Backend:** PHP Native (arsitektur modular dengan `includes/`)
* **Database:** MySQL / MariaDB (`database/laptier.sql`)
* **Frontend:** HTML5, CSS3 (`assets/css/style.css`), Vanilla JavaScript (`assets/js/app.js`), dan ikon vektor SVG
* **Keamanan Direktori:** Konfigurasi `.htaccess` pada *root* serta direktori `config/`, `database/`, dan `uploads/`

```text
laptier/
├── admin/                  # Modul panel administrator (auth, dashboard, CRUD laptop, settings)
├── assets/                 # Aset statis (CSS, JS, logo & placeholder SVG)
│   ├── css/style.css
│   ├── images/
│   └── js/app.js
├── config/                 # Konfigurasi koneksi database (database.php)
├── database/               # Skema & data awal SQL (laptier.sql)
├── includes/               # Komponen UI & fungsi pembantu (header, footer, functions, product-card)
├── uploads/                # Direktori penyimpanan gambar produk laptop
├── index.php               # Halaman utama
├── katalog.php             # Halaman katalog laptop
├── detail.php              # Halaman detail spesifikasi laptop
├── tier-list.php           # Halaman pemeringkatan tier list
├── bandingkan.php          # Halaman perbandingan laptop
├── rekomendasi.php         # Halaman rekomendasi laptop
├── panduan.php             # Halaman panduan pengguna
├── MULAI_DI_SINI.txt       # Catatan panduan cepat penggunaan awal
└── README.md               # Dokumentasi repositori<img width="1595" height="3064" alt="laptier gt tc_index php" src="https://github.com/user-attachments/assets/4e7fd9b9-58b4-433b-ab7a-fa764a533e3e" />
