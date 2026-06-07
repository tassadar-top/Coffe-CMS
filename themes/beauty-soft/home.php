<section class="theme-hero theme-hero-split">
    <div class="theme-copy">
        <p class="theme-kicker">Beauty Profile</p>
        <h1><?= \App\Core\Security::escape($page['title'] ?? 'Beauty Soft'); ?></h1>
        <p><?= \App\Core\Security::escape($page['content'] ?? ($demoPages['home'] ?? 'Calm beauty layout for appointments, services, and portfolio.')); ?></p>
        <div class="inline-actions">
            <a class="button" href="<?= base_url('services'); ?>">Services</a>
            <a class="button secondary" href="<?= base_url('portfolio'); ?>">Results</a>
        </div>
    </div>
    <div class="theme-placeholder">Soft studio visual</div>
</section>
