<section class="theme-hero theme-hero-centered">
    <p class="theme-kicker">Late Night Delivery Theme</p>
    <h1><?= \App\Core\Security::escape($page['title'] ?? 'Shawarma Night'); ?></h1>
    <p><?= \App\Core\Security::escape($page['content'] ?? ($demoPages['home'] ?? 'Delivery-focused storefront with strong contrast and quick order flow.')); ?></p>
    <div class="inline-actions">
        <a class="button" href="<?= base_url('menu'); ?>">See menu</a>
    </div>
</section>
