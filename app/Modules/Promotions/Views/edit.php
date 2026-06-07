<section class="admin-card">
    <h1>Edit Promotion</h1>
    <form class="stack" method="post" action="<?= base_url($adminPath . '/promotions/update'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="<?= \App\Core\Security::escape($csrfKey); ?>" value="<?= \App\Core\Security::escape($csrf); ?>">
        <input type="hidden" name="id" value="<?= (int) $promotion['id']; ?>">
        <label>
            Title
            <input type="text" name="title" value="<?= \App\Core\Security::escape($promotion['title']); ?>" required>
        </label>
        <label>
            Description
            <textarea name="description" required><?= \App\Core\Security::escape($promotion['description']); ?></textarea>
        </label>
        <label>
            Image alt text
            <input type="text" name="image_alt" value="<?= \App\Core\Security::escape((string) ($promotion['image_alt'] ?? '')); ?>">
        </label>
        <div class="grid two">
            <label>
                Starts at
                <input type="datetime-local" name="starts_at" value="<?= date('Y-m-d\TH:i', strtotime((string) $promotion['starts_at'])); ?>">
            </label>
            <label>
                Ends at
                <input type="datetime-local" name="ends_at" value="<?= date('Y-m-d\TH:i', strtotime((string) $promotion['ends_at'])); ?>">
            </label>
        </div>
        <label>
            Status
            <select name="status">
                <option value="active" <?= $promotion['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                <option value="inactive" <?= $promotion['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </label>
        <?php if (!empty($promotion['image'])): ?>
            <div class="stack">
                <img class="preview-image" src="<?= public_upload_url($promotion['image']); ?>" alt="<?= \App\Core\Security::escape($promotion['image_alt'] ?: $promotion['title']); ?>">
                <label><input type="checkbox" name="remove_image" value="1"> Remove current image</label>
            </div>
        <?php endif; ?>
        <label>
            Upload new image
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
        </label>
        <div class="inline-actions">
            <button type="submit">Save</button>
            <a class="button secondary" href="<?= base_url($adminPath . '/promotions'); ?>">Back</a>
        </div>
    </form>
</section>
