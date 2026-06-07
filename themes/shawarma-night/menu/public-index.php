<section class="section">
    <div class="theme-hero theme-hero-centered">
        <p class="theme-kicker">Night Delivery Menu</p>
        <h1>Late Night Catalog</h1>
        <p>High-contrast menu designed for quick decisions, combo focus, and after-hours ordering.</p>
    </div>
    <div class="grid three section">
        <?php foreach ($items as $item): ?>
            <article class="card stack">
                <p class="meta"><?= \App\Core\Security::escape((string) $item['category_title']); ?></p>
                <h2><?= \App\Core\Security::escape($item['title']); ?></h2>
                <strong><?= \App\Core\Security::escape($item['price']); ?></strong>
            </article>
        <?php endforeach; ?>
    </div>
</section>
