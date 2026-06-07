<section class="theme-hero theme-hero-centered">
    <p class="theme-kicker">Night Coffee Theme</p>
    <h1><?= \App\Core\Security::escape($page['title'] ?? 'Coffee After Dark'); ?></h1>
    <p><?= \App\Core\Security::escape($page['content'] ?? ($demoPages['home'] ?? 'Dark premium storefront for evening coffee and desserts.')); ?></p>
    <div class="inline-actions">
        <a class="button" href="<?= base_url('menu'); ?>">Open catalog</a>
    </div>
</section>
<section class="grid two section">
    <article class="card"><h2>Atmosphere</h2><p><?= \App\Core\Security::escape($about['content'] ?? ($demoPages['about'] ?? 'Evening mood, premium desserts, intimate service.')); ?></p></article>
    <article class="card"><h2>Visit us</h2><p><?= \App\Core\Security::escape($contacts['content'] ?? ($demoPages['contacts'] ?? 'Address, map, and hours.')); ?></p></article>
</section>
