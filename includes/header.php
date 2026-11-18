<?php
$page_title = $page_title ?? 'Pilihan laptop yang masuk akal';
$active_page = $active_page ?? '';
$site_name = setting('site_name', 'LapTier');
$tokopedia_url = setting('tokopedia_url', 'https://www.tokopedia.com/');
$notice = setting('demo_notice', 'TEMUKAN LAPTOP TERBAIK UNTUK KEBUTUHAN ANDA');
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#171c20">
  <meta name="description" content="Panduan memilih laptop sesuai kebutuhan dan budget. Bandingkan spesifikasi, kondisi, tier, dan harga sebelum membeli.">
  <title><?= h($page_title) ?> — <?= h($site_name) ?></title>
  <link rel="icon" href="assets/images/logo-mark.svg" type="image/svg+xml">
  <link rel="stylesheet" href="assets/css/style.css?v=1.0.0">
</head>
<body>
<?php if ($notice !== ''): ?><div class="demo-strip"><span class="demo-dot"></span><?= h($notice) ?></div><?php endif; ?>
<header class="site-header">
  <a class="brand" href="index.php" aria-label="LapTier beranda"><span class="brand-mark">L<span>/</span>T</span><span class="brand-word"><?= h($site_name) ?><small>FIELD GUIDE FOR LAPTOPS</small></span></a>
  <button class="nav-toggle" type="button" aria-label="Buka navigasi" aria-expanded="false">☰</button>
  <nav class="main-nav" aria-label="Navigasi utama">
    <a class="<?= $active_page==='home'?'active':'' ?>" href="index.php">Beranda</a>
    <a class="<?= $active_page==='catalog'?'active':'' ?>" href="katalog.php">Katalog</a>
    <a class="<?= $active_page==='recommend'?'active':'' ?>" href="rekomendasi.php">Cari laptop</a>
    <a class="<?= $active_page==='tiers'?'active':'' ?>" href="tier-list.php">Tier list</a>
    <a class="compare-link" href="bandingkan.php">Bandingkan <span class="compare-count">0</span></a>
  </nav>
  <a class="button button-dark button-small tokopedia-button" href="<?= h($tokopedia_url) ?>" target="_blank" rel="noopener noreferrer">Tokopedia <span aria-hidden="true">↗</span></a>
</header>
<main>
