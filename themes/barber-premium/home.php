<section class="theme-hero theme-hero-centered">
    <p class="theme-kicker">Premium Barber Theme</p>
    <h1><?= \App\Core\Security::escape($page['title'] ?? 'Premium Cuts'); ?></h1>
    <p><?= \App\Core\Security::escape($page['content'] ?? ($demoPages['home'] ?? 'Luxury grooming theme focused on brand presence and booking.')); ?></p>
    <div class="inline-actions">
        <a class="button" href="<?= base_url('services'); ?>">Explore services</a>
    </div>
</section>
