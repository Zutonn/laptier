<?php
/** @var array $product */
$cases = case_labels($product['use_cases'] ?? '');
?>
<article class="product-card">
  <div class="product-media">
    <span class="product-index">LT / <?= str_pad((string)($product['id'] ?? 0), 2, '0', STR_PAD_LEFT) ?></span>
    <span class="tier-badge <?= h(tier_class((string)$product['tier'])) ?>"><?= h($product['tier']) ?></span>
    <a class="product-image-link" href="detail.php?id=<?= (int)$product['id'] ?>" aria-label="Lihat <?= h($product['name']) ?>"><img src="<?= h(product_image($product['image_path'] ?? null)) ?>" alt="<?= h($product['name']) ?>" loading="lazy" onerror="this.onerror=null;this.src='assets/images/laptop-placeholder.svg'"></a>
    <?php if (($product['condition_type'] ?? '') === 'Bekas'): ?><span class="condition-stamp">SECOND / USED</span><?php endif; ?>
  </div>
  <div class="product-card-body">
    <div class="product-kicker"><span><?= h($product['brand'] ?: 'Laptop') ?></span><span><?= h($product['category_type']) ?></span></div>
    <h3><a href="detail.php?id=<?= (int)$product['id'] ?>"><?= h($product['name']) ?></a></h3>
    <p class="product-spec-short"><?= h($product['processor'] ?: 'Prosesor belum diisi') ?> <span>·</span> <?= (int)$product['ram_gb'] ?> GB RAM <span>·</span> <?= h($product['storage_gb'] ?: '—') ?> GB SSD</p>
    <div class="case-tags"><?php foreach (array_slice($cases, 0, 2) as $case): ?><span><?= h($case) ?></span><?php endforeach; ?></div>
    <div class="product-card-bottom"><div><small>Harga referensi</small><strong><?= rupiah($product['price']) ?></strong></div><button class="compare-toggle" type="button" data-product-id="<?= (int)$product['id'] ?>" aria-pressed="false">+ Bandingkan</button></div>
  </div>
</article>
