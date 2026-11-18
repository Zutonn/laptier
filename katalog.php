<?php
require_once __DIR__ . '/includes/bootstrap.php';
$page_title = 'Katalog Laptop'; $active_page = 'catalog';
$q = trim((string)($_GET['q'] ?? ''));
$min = trim((string)($_GET['min'] ?? '')); $max = trim((string)($_GET['max'] ?? ''));
$condition = (string)($_GET['condition'] ?? ''); $category = (string)($_GET['category'] ?? ''); $tier = (string)($_GET['tier'] ?? '');
$sort = (string)($_GET['sort'] ?? 'recommended');
$where = ['is_published = 1']; $params = [];
if ($q !== '') { $where[] = '(name LIKE :q OR brand LIKE :q2 OR processor LIKE :q3 OR gpu LIKE :q4 OR use_cases LIKE :q5)'; $like = '%' . $q . '%'; foreach (['q','q2','q3','q4','q5'] as $k) $params[$k] = $like; }
if ($min !== '' && is_numeric($min)) { $where[] = 'price >= :min_price'; $params['min_price'] = max(0, (int)$min); }
if ($max !== '' && is_numeric($max)) { $where[] = 'price <= :max_price'; $params['max_price'] = max(0, (int)$max); }
if (in_array($condition, ['Baru','Bekas'], true)) { $where[] = 'condition_type = :condition_type'; $params['condition_type'] = $condition; }
if (in_array($category, ['Global','ODM'], true)) { $where[] = 'category_type = :category_type'; $params['category_type'] = $category; }
if (in_array($tier, ['C','B','B+','A','A+','S','S+'], true)) { $where[] = 'tier = :tier'; $params['tier'] = $tier; }
$order = match ($sort) { 'price_asc' => 'price ASC', 'price_desc' => 'price DESC', 'tier' => "FIELD(tier,'S+','S','A+','A','B+','B','C'), price ASC", 'newest' => 'created_at DESC', default => 'is_featured DESC, FIELD(tier,\'S+\',\'S\',\'A+\',\'A\',\'B+\',\'B\',\'C\'), price ASC' };
$sql = 'SELECT * FROM laptops WHERE ' . implode(' AND ', $where) . ' ORDER BY ' . $order . ' LIMIT 100';
$stmt = db()->prepare($sql); $stmt->execute($params); $products = $stmt->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<div class="page-wrap"><section class="page-hero"><div class="page-hero-grid"><div><div class="eyebrow" style="color:var(--ink)">Index / Laptop database</div><h1 class="page-title">Cari laptop yang<br><em>pas, bukan asal.</em></h1><p class="page-description">Saring berdasarkan harga, kondisi, kategori dan tier. Kalau ada dua kandidat yang bikin galau, masukkan ke daftar bandingkan. Kita tidak menghakimi.</p></div><aside class="side-note"><strong>Field note / 001</strong>Kategori Global dan ODM mengikuti klasifikasi yang dimasukkan pengelola. Selalu periksa model dan spesifikasi persis sebelum membeli.</aside></div></section>
  <div class="catalog-shell">
    <aside class="filter-panel"><div class="filter-title"><span>Filter lab / 01</span><a href="katalog.php">Reset ↺</a></div><form method="get" action="katalog.php"><div class="filter-form-grid">
      <div class="filter-group"><label class="group-label" for="q">Kata kunci</label><input class="field" id="q" name="q" value="<?= h($q) ?>" placeholder="Nama, CPU, gaming..."></div>
      <div class="filter-group"><label class="group-label">Rentang harga (Rp)</label><div class="filter-price"><input class="field" type="number" min="0" name="min" value="<?= h($min) ?>" placeholder="Min"><input class="field" type="number" min="0" name="max" value="<?= h($max) ?>" placeholder="Maks"></div></div>
      <div class="filter-group"><label class="group-label">Kondisi barang</label><div class="check-list"><label class="check-row"><input type="radio" name="condition" value="" <?= $condition===''?'checked':'' ?>> Semua kondisi</label><label class="check-row"><input type="radio" name="condition" value="Baru" <?= $condition==='Baru'?'checked':'' ?>> Baru</label><label class="check-row"><input type="radio" name="condition" value="Bekas" <?= $condition==='Bekas'?'checked':'' ?>> Bekas / second</label></div></div>
      <div class="filter-group"><label class="group-label">Kategori produk</label><div class="check-list"><label class="check-row"><input type="radio" name="category" value="" <?= $category===''?'checked':'' ?>> Semua kategori</label><label class="check-row"><input type="radio" name="category" value="Global" <?= $category==='Global'?'checked':'' ?>> Global / brand</label><label class="check-row"><input type="radio" name="category" value="ODM" <?= $category==='ODM'?'checked':'' ?>> ODM</label></div></div>
      <div class="filter-group"><label class="group-label">Pilih tier</label><div class="check-list"><label class="check-row"><input type="radio" name="tier" value="" <?= $tier===''?'checked':'' ?>> Semua tier</label><?php foreach (['S+','S','A+','A','B+','B','C'] as $t): ?><label class="check-row"><input type="radio" name="tier" value="<?= h($t) ?>" <?= $tier===$t?'checked':'' ?>> Tier <?= h($t) ?></label><?php endforeach; ?></div></div>
      <input type="hidden" name="sort" value="<?= h($sort) ?>"><div class="filter-actions"><button class="button button-dark" type="submit">Terapkan filter <span>↗</span></button></div>
    </div></form></aside>
    <section class="catalog-results"><div class="catalog-toolbar"><div class="result-count"><strong><?= count($products) ?> laptop</strong> ditemukan<?= $q!==''?' untuk “'.h($q).'”':'' ?> <span>· Maksimal 100 hasil</span></div><form method="get" action="katalog.php" class="sort-form"><?php foreach (['q'=>$q,'min'=>$min,'max'=>$max,'condition'=>$condition,'category'=>$category,'tier'=>$tier] as $key=>$val): ?><input type="hidden" name="<?= h($key) ?>" value="<?= h($val) ?>"><?php endforeach; ?><select class="field sort-select" name="sort" onchange="this.form.submit()"><option value="recommended" <?= $sort==='recommended'?'selected':'' ?>>Pilihan editor</option><option value="price_asc" <?= $sort==='price_asc'?'selected':'' ?>>Harga termurah</option><option value="price_desc" <?= $sort==='price_desc'?'selected':'' ?>>Harga termahal</option><option value="tier" <?= $sort==='tier'?'selected':'' ?>>Tier tertinggi</option><option value="newest" <?= $sort==='newest'?'selected':'' ?>>Terbaru ditambahkan</option></select><noscript><button class="button button-dark button-small">Urutkan</button></noscript></form></div>
    <?php if ($products): ?><div class="product-grid catalog-grid"><?php foreach ($products as $product) require __DIR__ . '/includes/product-card.php'; ?></div><?php else: ?><div class="empty-state"><strong>Tidak ada laptop yang cocok dengan filter ini.</strong><p>Coba longgarkan rentang harga atau hapus salah satu filter. Algoritma belum bisa membaca pikiran, sayangnya.</p><a class="button button-dark" href="katalog.php">Reset semua filter ↗</a></div><?php endif; ?><p class="result-footnote">Catatan: harga merupakan harga referensi yang dapat berubah. Gunakan tautan toko di halaman detail untuk memeriksa stok, varian, dan harga terbaru. Kategori dan tier ditetapkan pengelola, bukan standar resmi industri.</p>
    </section>
  </div></div>
<?php require __DIR__ . '/includes/footer.php'; ?>
