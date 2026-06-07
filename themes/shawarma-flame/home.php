<section class="theme-hero theme-hero-split">
    <div class="theme-copy">
        <p class="theme-kicker">Fast Casual Profile</p>
        <h1><?= \App\Core\Security::escape($page['title'] ?? 'Shawarma Flame'); ?></h1>
        <p><?= \App\Core\Security::escape($page['content'] ?? ($demoPages['home'] ?? 'High-energy storefront designed for catalog, orders, and repeat customers.')); ?></p>
        <div class="inline-actions">
            <a class="button" href="<?= base_url('menu'); ?>">Order now</a>
            <a class="button secondary" href="<?= base_url('account'); ?>">My account</a>
        </div>
    </div>
    <div class="theme-placeholder">Hot grill / food visual</div>
</section>
