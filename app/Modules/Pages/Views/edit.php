<section class="admin-card">
    <h1>Edit Page</h1>
    <form class="stack" method="post" action="<?= base_url($adminPath . '/pages/update'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="<?= \App\Core\Security::escape($csrfKey); ?>" value="<?= \App\Core\Security::escape($csrf); ?>">
        <input type="hidden" name="id" value="<?= (int) $page['id']; ?>">
        <label>
            Title
            <input type="text" name="title" value="<?= \App\Core\Security::escape($page['title']); ?>" required>
        </label>
        <label>
            Slug
            <input type="text" name="slug" value="<?= \App\Core\Security::escape($page['slug']); ?>" required>
        </label>
        <label>
            Description
            <textarea name="content" required><?= \App\Core\Security::escape($page['content']); ?></textarea>
        </label>
        <label>
            Image alt text
            <input type="text" name="image_alt" value="<?= \App\Core\Security::escape((string) ($page['image_alt'] ?? '')); ?>">
        </label>
        <?php if (!empty($page['image_path'])): ?>
            <div class="stack">
                <img class="preview-image" src="<?= public_upload_url($page['image_path']); ?>" alt="<?= \App\Core\Security::escape($page['image_alt'] ?? $page['title']); ?>">
                <label><input type="checkbox" name="remove_image" value="1"> Remove current image</label>
            </div>
        <?php endif; ?>
        <label>
            Upload new image
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
        </label>
        <div class="inline-actions">
            <button type="submit">Save</button>
            <a class="button secondary" href="<?= base_url($adminPath . '/pages'); ?>">Back</a>
        </div>
    </form>
</section>
