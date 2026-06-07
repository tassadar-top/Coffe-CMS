<section class="hero">
    <div class="hero-copy">
        <p class="meta"><?= \App\Core\Security::escape($profile['name'] ?? 'Business Site'); ?></p>
        <h1><?= \App\Core\Security::escape($page['title'] ?? ($profile['name'] ?? 'Business CMS')); ?></h1>
        <p><?= \App\Core\Security::escape($page['content'] ?? ($demoPages['home'] ?? 'Modular business website with one CMS core and switchable profiles.')); ?></p>
        <div class="inline-actions">
            <?php if (($profile['key'] ?? '') === 'barber_shop'): ?>
                <a class="button" href="<?= base_url('services'); ?>">View services</a>
            <?php else: ?>
                <a class="button" href="<?= base_url('menu'); ?>">View menu</a>
            <?php endif; ?>
            <a class="button secondary" href="#contacts">Contacts</a>
        </div>
    </div>
    <div>
        <?php if (!empty($page['image_path'])): ?>
            <img class="preview-image" src="<?= public_upload_url($page['image_path']); ?>" alt="<?= \App\Core\Security::escape($page['image_alt'] ?? $page['title']); ?>">
        <?php else: ?>
            <div class="card">
                <p class="meta">Add the hero image in the admin panel.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="section grid two">
    <article class="card">
        <h2><?= \App\Core\Security::escape($about['title'] ?? 'About'); ?></h2>
        <p><?= \App\Core\Security::escape($about['content'] ?? ($demoPages['about'] ?? 'Brand story, team, and atmosphere.')); ?></p>
    </article>
    <article id="contacts" class="card">
        <h2><?= \App\Core\Security::escape($contacts['title'] ?? 'Contacts'); ?></h2>
        <p><?= \App\Core\Security::escape($contacts['content'] ?? ($demoPages['contacts'] ?? 'Address, opening hours, and contact details.')); ?></p>
    </article>
</section>
