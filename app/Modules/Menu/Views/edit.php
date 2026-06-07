<section class="admin-card">
    <h1>Edit Catalog Item</h1>
    <form class="stack" method="post" action="<?= base_url($adminPath . '/menu/update'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="<?= \App\Core\Security::escape($csrfKey); ?>" value="<?= \App\Core\Security::escape($csrf); ?>">
        <input type="hidden" name="id" value="<?= (int) $item['id']; ?>">
        <label>
            Category
            <select name="category_id">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= (int) $category['id']; ?>" <?= (int) $category['id'] === (int) $item['category_id'] ? 'selected' : ''; ?>>
                        <?= \App\Core\Security::escape($category['title']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>
            Title
            <input type="text" name="title" value="<?= \App\Core\Security::escape($item['title']); ?>" required>
        </label>
        <label>
            Description
            <textarea name="description" required><?= \App\Core\Security::escape($item['description']); ?></textarea>
        </label>
        <label>
            Price
            <input type="text" name="price" value="<?= \App\Core\Security::escape($item['price']); ?>" required>
        </label>
        <label>
            Image alt text
            <input type="text" name="image_alt" value="<?= \App\Core\Security::escape((string) ($item['image_alt'] ?? '')); ?>">
        </label>
        <label>
            Status
            <select name="status">
                <option value="active" <?= $item['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                <option value="hidden" <?= $item['status'] === 'hidden' ? 'selected' : ''; ?>>Hidden</option>
            </select>
        </label>
        <label>
            Sort order
            <input type="number" name="sort_order" value="<?= (int) $item['sort_order']; ?>">
        </label>
        <label><input type="checkbox" name="is_popular" value="1" <?= (int) $item['is_popular'] === 1 ? 'checked' : ''; ?>> Popular</label>
        <label><input type="checkbox" name="is_new" value="1" <?= (int) $item['is_new'] === 1 ? 'checked' : ''; ?>> New</label>
        <label><input type="checkbox" name="is_showcase" value="1" <?= (int) ($item['is_showcase'] ?? 1) === 1 ? 'checked' : ''; ?>> Show on storefront</label>
        <label><input type="checkbox" name="is_purchasable" value="1" <?= (int) ($item['is_purchasable'] ?? 0) === 1 ? 'checked' : ''; ?>> Can be purchased</label>
        <?php if (!empty($item['image'])): ?>
            <div class="stack">
                <img class="preview-image" src="<?= public_upload_url($item['image']); ?>" alt="<?= \App\Core\Security::escape($item['image_alt'] ?: $item['title']); ?>">
                <label><input type="checkbox" name="remove_image" value="1"> Remove current image</label>
            </div>
        <?php endif; ?>
        <label>
            Upload new image
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
        </label>
        <div class="inline-actions">
            <button type="submit">Save</button>
            <a class="button secondary" href="<?= base_url($adminPath . '/menu'); ?>">Back</a>
        </div>
    </form>
</section>
