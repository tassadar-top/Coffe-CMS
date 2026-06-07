<section class="section">
    <div class="card">
        <p class="theme-kicker">Coffee Catalog</p>
        <h1>Menu Highlights</h1>
        <p>Warm card-based layout for drinks, pastries, and seasonal specials.</p>
    </div>
    <div class="grid three section">
        <?php foreach ($items as $item): ?>
            <article class="card stack">
                <?php if (!empty($item['image'])): ?>
                    <img class="menu-item-image" src="<?= public_upload_url($item['image']); ?>" alt="<?= \App\Core\Security::escape($item['image_alt'] ?: $item['title']); ?>">
                <?php endif; ?>
                <p class="meta"><?= \App\Core\Security::escape((string) $item['category_title']); ?></p>
                <h2><?= \App\Core\Security::escape($item['title']); ?></h2>
                <p><?= \App\Core\Security::escape($item['description']); ?></p>
                <strong><?= \App\Core\Security::escape($item['price']); ?></strong>
            </article>
        <?php endforeach; ?>
    </div>
</section>
