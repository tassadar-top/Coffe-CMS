<section class="section">
    <div class="theme-hero theme-hero-centered">
        <p class="theme-kicker">Night Catalog</p>
        <h1>Signature Drinks</h1>
        <p>Dark showcase for coffee, desserts, and premium evening menu items.</p>
    </div>
    <div class="grid three section">
        <?php foreach ($items as $item): ?>
            <article class="card stack">
                <p class="meta"><?= \App\Core\Security::escape((string) $item['category_title']); ?></p>
                <h2><?= \App\Core\Security::escape($item['title']); ?></h2>
                <p><?= \App\Core\Security::escape($item['description']); ?></p>
                <strong><?= \App\Core\Security::escape($item['price']); ?></strong>
            </article>
        <?php endforeach; ?>
    </div>
</section>
