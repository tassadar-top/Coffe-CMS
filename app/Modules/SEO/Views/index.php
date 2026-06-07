<section class="admin-card">
    <h1>SEO</h1>
    <form class="stack" method="post" action="<?= base_url($adminPath . '/seo/update'); ?>">
        <input type="hidden" name="<?= \App\Core\Security::escape($csrfKey); ?>" value="<?= \App\Core\Security::escape($csrf); ?>">
        <?php foreach ($rows as $index => $row): ?>
            <div class="list-card stack">
                <input type="hidden" name="id[]" value="<?= (int) $row['id']; ?>">
                <strong><?= \App\Core\Security::escape($row['entity_type']); ?> #<?= (int) $row['entity_id']; ?></strong>
                <label>
                    Meta title
                    <input type="text" name="meta_title[]" value="<?= \App\Core\Security::escape((string) $row['meta_title']); ?>">
                </label>
                <label>
                    Meta description
                    <textarea name="meta_description[]"><?= \App\Core\Security::escape((string) $row['meta_description']); ?></textarea>
                </label>
                <label>
                    Canonical URL
                    <input type="text" name="canonical_url[]" value="<?= \App\Core\Security::escape((string) $row['canonical_url']); ?>">
                </label>
                <label>
                    Robots
                    <input type="text" name="robots[]" value="<?= \App\Core\Security::escape((string) $row['robots']); ?>">
                </label>
            </div>
        <?php endforeach; ?>
        <button type="submit">Зберегти SEO</button>
    </form>
</section>
