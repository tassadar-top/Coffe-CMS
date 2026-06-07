<section class="section">
    <div class="card">
        <p class="theme-kicker">Hot Menu</p>
        <h1>Shawarma Catalog</h1>
        <p>Fast ordering template for wraps, combo meals, add-ons, and orderable positions.</p>
    </div>
    <div class="grid three section">
        <?php foreach ($items as $item): ?>
            <article class="card stack">
                <h2><?= \App\Core\Security::escape($item['title']); ?></h2>
                <p><?= \App\Core\Security::escape($item['description']); ?></p>
                <strong><?= \App\Core\Security::escape($item['price']); ?></strong>
                <span class="small"><?= (int) ($item['is_purchasable'] ?? 0) === 1 ? 'Ready to order' : 'Showcase only'; ?></span>
            </article>
        <?php endforeach; ?>
    </div>
</section>
