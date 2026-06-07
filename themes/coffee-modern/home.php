<section class="theme-hero theme-hero-split">
    <div class="theme-copy">
        <p class="theme-kicker">Coffee Profile</p>
        <h1><?= \App\Core\Security::escape($page['title'] ?? 'Coffee Modern'); ?></h1>
        <p><?= \App\Core\Security::escape($page['content'] ?? ($demoPages['home'] ?? 'Coffee storefront with a warm editorial hero.')); ?></p>
        <div class="inline-actions">
            <a class="button" href="<?= base_url('menu'); ?>">View menu</a>
            <a class="button secondary" href="<?= base_url('promotions'); ?>">Promotions</a>
        </div>
    </div>
    <div class="theme-visual">
        <?php if (!empty($page['image_path'])): ?>
            <img class="preview-image" src="<?= public_upload_url($page['image_path']); ?>" alt="<?= \App\Core\Security::escape($page['image_alt'] ?? $page['title']); ?>">
        <?php else: ?>
            <div class="theme-placeholder">Signature coffee visuals go here.</div>
        <?php endif; ?>
    </div>
</section>
<section class="grid two section">
    <article class="card"><h2>About</h2><p><?= \App\Core\Security::escape($about['content'] ?? ($demoPages['about'] ?? 'Brand story and atmosphere.')); ?></p></article>
    <article class="card"><h2>Contacts</h2><p><?= \App\Core\Security::escape($contacts['content'] ?? ($demoPages['contacts'] ?? 'Address and opening hours.')); ?></p></article>
</section>
