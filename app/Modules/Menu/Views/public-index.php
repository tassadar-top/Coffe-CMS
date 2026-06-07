<section class="section">
    <h1>Catalog</h1>
    <div class="grid three">
        <?php foreach ($items as $item): ?>
            <article class="card stack">
                <?php if (!empty($item['image'])): ?>
                    <img class="menu-item-image" src="<?= public_upload_url($item['image']); ?>" alt="<?= \App\Core\Security::escape($item['image_alt'] ?: $item['title']); ?>">
                <?php endif; ?>
                <div>
                    <p class="meta"><?= \App\Core\Security::escape((string) $item['category_title']); ?></p>
                    <h2><?= \App\Core\Security::escape($item['title']); ?></h2>
                    <p><?= \App\Core\Security::escape($item['description']); ?></p>
                </div>
                <strong><?= \App\Core\Security::escape($item['price']); ?></strong>
                <?php if ((int) ($item['is_purchasable'] ?? 0) === 1): ?>
                    <span class="small">Available for order</span>
                <?php else: ?>
                    <span class="small">Showcase only</span>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    </div>
</section>
