<section class="section">
    <h1>Promotions</h1>
    <div class="grid two">
        <?php foreach ($promotions as $promotion): ?>
            <article class="card stack">
                <?php if (!empty($promotion['image'])): ?>
                    <img class="preview-image" src="<?= public_upload_url($promotion['image']); ?>" alt="<?= \App\Core\Security::escape($promotion['image_alt'] ?: $promotion['title']); ?>">
                <?php endif; ?>
                <div>
                    <h2><?= \App\Core\Security::escape($promotion['title']); ?></h2>
                    <p><?= \App\Core\Security::escape($promotion['description']); ?></p>
                    <p class="meta"><?= \App\Core\Security::escape($promotion['starts_at']); ?> - <?= \App\Core\Security::escape($promotion['ends_at']); ?></p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>
