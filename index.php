<?php
require_once __DIR__ . '/includes/bootstrap.php';
$page_title = 'Laptop yang cocok, bukan yang sekadar mahal';
$active_page = 'home';
$stmt = db()->query("SELECT * FROM laptops WHERE is_published = 1 ORDER BY is_featured DESC, FIELD(tier,'S+','S','A+','A','B+','B','C'), price ASC LIMIT 3");
$featured = $stmt->fetchAll();
$total = (int)db()->query('SELECT COUNT(*) FROM laptops WHERE is_published=1')->fetchColumn();
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div class="hero-inner">
    <div class="hero-content">
      <div class="eyebrow">Laptop buying field guide · Indonesia</div>
      <h1>Jangan beli<br>laptop cuma<br>karena <em>katanya bagus.</em></h1>
      <p class="hero-copy"><?= h(setting('hero_description', 'Laptop yang tepat bukan yang paling mahal. Ini soal kebutuhanmu, isi dompetmu, dan berapa lama kamu ingin memakainya tanpa menyesal.')) ?></p>
      <div class="hero-actions"><a class="button button-lime" href="katalog.php">Jelajahi katalog <span>↗</span></a><a class="button button-light" href="rekomendasi.php">Bantu pilihkan laptop <span>↗</span></a></div>
    </div>
    <div class="hero-art" aria-hidden="true"><div class="orbit"></div><span class="art-tag top">FIG. 01 / LAPTOP INDEX</span><div class="art-laptop"><div class="screen"><div class="screen-grid"></div><div class="screen-burst"></div><div class="screen-label">L/T<small>FIND YOUR FIT — 2026</small></div></div><div class="laptop-base"></div></div><span class="art-tag bottom">BUDGET FIRST. SPECS SECOND.</span></div>
  </div>
  <div class="hero-meta"><span>01 / Kebutuhan sebelum gengsi</span><span><?= number_format($total) ?> produk terdaftar <span aria-hidden="true">↗</span></span><span>Berdasarkan fakta, bukan sekadar tren.</span></div>
</section>
<div class="page-wrap">
  <section class="section">
    <div class="section-head"><div><div class="kicker">01 — Editor's shortlist</div><h2>Mulai dari pilihan<br><em>yang masuk akal.</em></h2></div><a class="text-link" href="katalog.php">Semua laptop <span>↗</span></a></div>
    <?php if ($featured): ?><div class="product-grid"><?php foreach ($featured as $product) require __DIR__ . '/includes/product-card.php'; ?></div><?php else: ?><div class="empty-state"><strong>Katalognya masih kosong.</strong><p>Tambahkan produk melalui dashboard admin untuk mulai mengisi LapTier.</p><a class="button button-dark" href="admin/login.php">Masuk ke dashboard <span>↗</span></a></div><?php endif; ?>
  </section>
  <section class="section" style="padding-top:0"><div class="manifesto"><div><div class="mono-label">02 — The buying rule</div><h2>Spek tinggi belum tentu <em>pilihan tepat.</em></h2></div><div><p>Mahasiswa desain, anak SI, dan gamer punya kebutuhan yang beda. LapTier membantu menyaring pilihan berdasarkan budget, kondisi barang, kelas produk, dan kebutuhan sehari-hari. Bukan sekadar memuja angka prosesor.</p><a class="button button-dark" href="rekomendasi.php">Cari sesuai kebutuhan <span>↗</span></a></div></div></section>
  <section class="section" style="padding-top:0"><div class="section-head"><div><div class="kicker">03 — A quick map</div><h2>Baca tier list<br><em>tanpa bahasa planet lain.</em></h2></div><a class="text-link" href="tier-list.php">Cara kerja tier <span>↗</span></a></div><div class="tier-preview"><div class="tier-tile"><strong>S+</strong><span>Top tier</span><p>Kelas atas tanpa kompromi besar.</p></div><div class="tier-tile"><strong>S</strong><span>Flagship</span><p>Sangat kuat dan serba bisa.</p></div><div class="tier-tile"><strong>A+</strong><span>Excellent</span><p>Kencang, fitur seimbang.</p></div><div class="tier-tile"><strong>A</strong><span>Strong</span><p>Pilihan serius untuk jangka panjang.</p></div><div class="tier-tile"><strong>B+</strong><span>Good value</span><p>Performa bagus untuk uangnya.</p></div><div class="tier-tile"><strong>B</strong><span>Solid</span><p>Aman untuk penggunaan umum.</p></div><div class="tier-tile"><strong>C</strong><span>Entry</span><p>Basic, dengan kompromi yang jelas.</p></div></div></section>
  <section class="section" style="padding-top:0"><div class="section-head"><div><div class="kicker">04 — Buy smarter</div><h2>Tiga hal sebelum<br><em>klik beli.</em></h2></div></div><div class="guide-grid"><article class="guide-card"><span class="num">NOTE / 01</span><h3>Tetapkan batas budget</h3><p>Sisihkan uang untuk tas, adaptor, atau upgrade RAM jika dibutuhkan. Jangan habiskan seluruh dana hanya karena promo terlihat merah.</p></article><article class="guide-card"><span class="num">NOTE / 02</span><h3>Periksa generasi dan kondisi</h3><p>Nama prosesor saja belum cukup. Cek generasi, RAM, penyimpanan, kondisi baterai, dan garansi sebelum membayar.</p></article><article class="guide-card"><span class="num">NOTE / 03</span><h3>Bandingkan sebelum beli</h3><p>Pakai fitur perbandingan untuk membaca spesifikasi berdampingan, lalu cek harga terbaru pada tautan toko.</p></article></div></section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
