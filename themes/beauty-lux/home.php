<section class="theme-hero theme-hero-centered">
    <p class="theme-kicker">Luxury Beauty Theme</p>
    <h1><?= \App\Core\Security::escape($page['title'] ?? 'Beauty Lux'); ?></h1>
    <p><?= \App\Core\Security::escape($page['content'] ?? ($demoPages['home'] ?? 'Elegant beauty storefront with luxurious typography and soft motion.')); ?></p>
    <div class="inline-actions">
        <a class="button" href="<?= base_url('services'); ?>">View treatments</a>
    </div>
</section>
