-- LapTier database schema for MySQL / MariaDB
-- Import this file into a database you created in your hosting panel.
-- Demo rows below are illustrative: verify all prices, variants, specifications and tier decisions before public use.
SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS admins (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(190) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  last_login DATETIME NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id), UNIQUE KEY uq_admin_username (username), UNIQUE KEY uq_admin_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS laptops (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(190) NOT NULL,
  brand VARCHAR(100) NOT NULL DEFAULT '',
  price BIGINT UNSIGNED NOT NULL DEFAULT 0,
  condition_type ENUM('Baru','Bekas') NOT NULL DEFAULT 'Baru',
  category_type ENUM('Global','ODM') NOT NULL DEFAULT 'Global',
  tier VARCHAR(4) NOT NULL DEFAULT 'B',
  processor VARCHAR(190) NOT NULL DEFAULT '',
  gpu VARCHAR(190) NOT NULL DEFAULT '',
  ram_gb SMALLINT UNSIGNED NOT NULL DEFAULT 8,
  storage_gb SMALLINT UNSIGNED NOT NULL DEFAULT 512,
  storage_type VARCHAR(80) NOT NULL DEFAULT 'SSD',
  display_size VARCHAR(190) NOT NULL DEFAULT '',
  weight_kg DECIMAL(5,2) NULL,
  use_cases VARCHAR(255) NOT NULL DEFAULT 'Kuliah',
  description TEXT NULL,
  pros TEXT NULL,
  cons TEXT NULL,
  image_path VARCHAR(500) NULL,
  tokopedia_url VARCHAR(700) NULL,
  is_featured TINYINT(1) NOT NULL DEFAULT 0,
  is_published TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id), KEY idx_laptops_published (is_published), KEY idx_laptops_price (price), KEY idx_laptops_tier (tier), KEY idx_laptops_updated (updated_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS settings (
  setting_key VARCHAR(100) NOT NULL,
  setting_value TEXT NOT NULL,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO settings (setting_key, setting_value) VALUES
('site_name','LapTier'),
('hero_title','Jangan beli|laptop cuma|karena katanya bagus.'),
('hero_description','Laptop yang tepat bukan yang paling mahal. Ini soal kebutuhanmu, isi dompetmu, dan berapa lama kamu ingin memakainya tanpa menyesal.'),
('tokopedia_url','https://www.tokopedia.com/'),
('demo_notice','DATA DEMO • Harga dan spesifikasi awal hanya contoh. Verifikasi sebelum dipublikasikan.'),
('footer_text','Panduan memilih laptop untuk kebutuhan nyata, bukan sekadar angka di lembar spesifikasi.')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);

INSERT INTO laptops (name,brand,price,condition_type,category_type,tier,processor,gpu,ram_gb,storage_gb,storage_type,display_size,weight_kg,use_cases,description,pros,cons,image_path,tokopedia_url,is_featured,is_published) VALUES
('Lenovo IdeaPad Slim 3 14','Lenovo',6999000,'Baru','Global','B+','AMD Ryzen 5 7530U','AMD Radeon Graphics',16,512,'SSD NVMe','14 inci FHD IPS',1.43,'Kuliah, Produktivitas, Desain','DATA CONTOH. Periksa kode model, panel layar, kapasitas RAM, dan garansi pada listing penjual.','RAM 16 GB untuk multitasking\nSSD NVMe\nBentuk relatif ringkas','GPU terintegrasi bukan untuk game berat\nSpesifikasi bisa berbeda antar varian',NULL,'https://www.tokopedia.com/search?st=product&q=Lenovo%20IdeaPad%20Slim%203%2014',1,1),
('ASUS Vivobook Go 14','ASUS',5999000,'Baru','Global','B','AMD Ryzen 5 7520U','AMD Radeon 610M',8,512,'SSD NVMe','14 inci FHD',1.38,'Kuliah, Produktivitas','DATA CONTOH. Terdapat beberapa konfigurasi prosesor dan memori dalam seri ini. Cocokkan SKU dengan detail penjual.','Praktis untuk aktivitas sehari-hari\nBobot relatif ringan','Pastikan RAM dan kemampuan upgrade\nGPU terintegrasi untuk tugas ringan sampai menengah',NULL,'https://www.tokopedia.com/search?st=product&q=ASUS%20Vivobook%20Go%2014',1,1),
('Acer Aspire Lite 14','Acer',6499000,'Baru','Global','B+','Intel Core i5 U-series','Intel Iris Xe / UHD Graphics',16,512,'SSD NVMe','14 inci FHD',1.45,'Kuliah, Produktivitas, Teknik','DATA CONTOH. Nama seri dapat mencakup banyak varian. Verifikasi model prosesor dan jenis panel layar sebelum membeli.','RAM dan SSD cukup lega untuk kerja umum\nFormat ringkas','GPU bergantung pada SKU\nHarga dan fitur bervariasi menurut konfigurasi',NULL,'https://www.tokopedia.com/search?st=product&q=Acer%20Aspire%20Lite%2014',0,1),
('Dell Latitude 5420 (Bekas)','Dell',5300000,'Bekas','Global','A','Intel Core i5-1145G7','Intel Iris Xe Graphics',16,512,'SSD NVMe','14 inci FHD',1.37,'Kuliah, Produktivitas, Teknik','DATA CONTOH untuk ilustrasi kategori laptop bisnis bekas. Kondisi tiap unit sangat berbeda; minta hasil tes, kesehatan baterai, dan informasi garansi.','Bodi bisnis dan pilihan port yang praktis\nRAM/SSD dapat memadai untuk produktivitas','Kondisi baterai dan layar bergantung pada unit\nPastikan charger, BIOS, dan status perangkat',NULL,'https://www.tokopedia.com/search?st=product&q=Dell%20Latitude%205420',0,1),
('ASUS TUF Gaming F15 (contoh konfigurasi)','ASUS',8999000,'Bekas','Global','A','Intel Core i5 H-series','NVIDIA GeForce RTX 3050',16,512,'SSD NVMe','15.6 inci FHD 144 Hz',2.20,'Gaming, Teknik, Desain, Multimedia','DATA CONTOH. Pastikan generasi CPU/GPU, TGP, RAM, layar, kondisi pendingin dan garansi dari SKU yang spesifik.','GPU diskret untuk game dan aplikasi yang memanfaatkannya\nLayar refresh rate tinggi pada varian tertentu','Berat lebih besar dan baterai biasanya bukan fokus utama\nKondisi termal penting untuk unit bekas',NULL,'https://www.tokopedia.com/search?st=product&q=ASUS%20TUF%20Gaming%20F15%20RTX%203050',1,1),
('Lenovo LOQ 15 (contoh konfigurasi)','Lenovo',12999000,'Baru','Global','A+','Intel Core i5 H-series','NVIDIA GeForce RTX 4050',16,512,'SSD NVMe','15.6 inci FHD 144 Hz',2.40,'Gaming, Teknik, Desain, Multimedia','DATA CONTOH. Harga, GPU, TGP, layar, dan fitur Lenovo LOQ berbeda menurut kode model dan tahun. Verifikasi varian persisnya.','GPU diskret untuk beban grafis\nRAM/SSD dapat di-upgrade pada varian tertentu','Relatif berat untuk dibawa tiap hari\nAdaptor daya besar dan panas perlu diperhitungkan',NULL,'https://www.tokopedia.com/search?st=product&q=Lenovo%20LOQ%2015',1,1),
('MSI Raider GE78 HX (contoh kelas atas)','MSI',42999000,'Baru','Global','S+','Intel Core i9 HX-series','NVIDIA GeForce RTX 4080 / 4090',32,2048,'SSD NVMe','17 inci QHD+ high refresh rate',3.00,'Gaming, Teknik, Desain, Multimedia','DATA CONTOH kelas performa tinggi. Konfigurasi pada seri ini sangat beragam; cek SKU, GPU, daya grafis, suhu, dan garansi.','Performa tinggi pada konfigurasi tertentu\nLayar dan pendinginan kelas atas pada varian tertentu','Harga dan bobot tinggi\nBerlebihan untuk banyak tugas kuliah biasa',NULL,'https://www.tokopedia.com/search?st=product&q=MSI%20Raider%20GE78%20HX',0,1),
('ThinkPad X1 Carbon Gen 6 (Bekas)','Lenovo',3700000,'Bekas','Global','C','Intel Core i5 U-series generasi lama','Intel UHD Graphics',8,256,'SSD','14 inci FHD',1.13,'Kuliah, Produktivitas','DATA CONTOH laptop bisnis generasi lama. Nilai dan kelayakan bergantung pada kondisi fisik, kesehatan baterai, dan kebutuhan software modern.','Ringan dan mudah dibawa\nKeyboard dan bodi bisnis','Platform sudah tua\nRAM dapat tersolder dan tidak cocok untuk semua beban kerja',NULL,'https://www.tokopedia.com/search?st=product&q=ThinkPad%20X1%20Carbon%20Gen%206',0,1);
