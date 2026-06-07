<section class="theme-hero theme-hero-split">
    <div class="theme-copy">
        <p class="theme-kicker">Barber Profile</p>
        <h1><?= \App\Core\Security::escape($page['title'] ?? 'Classic Grooming'); ?></h1>
        <p><?= \App\Core\Security::escape($page['content'] ?? ($demoPages['home'] ?? 'Barber landing page with services, masters, and booking.')); ?></p>
        <div class="inline-actions">
            <a class="button" href="<?= base_url('services'); ?>">Services</a>
            <a class="button secondary" href="<?= base_url('portfolio'); ?>">Portfolio</a>
        </div>
    </div>
    <div class="theme-placeholder">Editorial portrait / shop interior</div>
</section>
<section class="grid two section">
    <article class="card"><h2>Studio</h2><p><?= \App\Core\Security::escape($about['content'] ?? ($demoPages['about'] ?? 'Team, style, and studio story.')); ?></p></article>
    <article class="card"><h2>Book</h2><p><?= \App\Core\Security::escape($contacts['content'] ?? ($demoPages['contacts'] ?? 'Find us and book your visit.')); ?></p></article>
</section>
