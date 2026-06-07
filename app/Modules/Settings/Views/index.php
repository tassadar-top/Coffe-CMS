<section class="admin-card">
    <h1>Business Settings</h1>
    <form class="stack" method="post" action="<?= base_url($adminPath . '/settings/update'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="<?= \App\Core\Security::escape($csrfKey); ?>" value="<?= \App\Core\Security::escape($csrf); ?>">

        <label>
            Business name
            <input type="text" name="business_name" value="<?= \App\Core\Security::escape((string) ($settingsForm['business_name'] ?? '')); ?>" required>
        </label>

        <label>
            Tagline
            <input type="text" name="tagline" value="<?= \App\Core\Security::escape((string) ($settingsForm['tagline'] ?? '')); ?>">
        </label>

        <label>
            Logo alt text
            <input type="text" name="logo_alt" value="<?= \App\Core\Security::escape((string) ($settingsForm['logo_alt'] ?? '')); ?>">
        </label>

        <?php if (!empty($settingsForm['logo_path'])): ?>
            <div class="stack">
                <img class="preview-image" src="<?= public_upload_url((string) $settingsForm['logo_path']); ?>" alt="<?= \App\Core\Security::escape((string) ($settingsForm['logo_alt'] ?? $settingsForm['business_name'] ?? 'Logo')); ?>" style="max-width: 240px;">
                <label><input type="checkbox" name="remove_logo" value="1"> Remove current logo</label>
            </div>
        <?php endif; ?>

        <label>
            Upload logo
            <input type="file" name="logo" accept=".jpg,.jpeg,.png,.webp">
        </label>

        <div class="grid two">
            <label>
                Contact phone
                <input type="text" name="contact_phone" value="<?= \App\Core\Security::escape((string) ($settingsForm['contact_phone'] ?? '')); ?>">
            </label>

            <label>
                Contact email
                <input type="email" name="contact_email" value="<?= \App\Core\Security::escape((string) ($settingsForm['contact_email'] ?? '')); ?>">
            </label>
        </div>

        <label>
            Address
            <textarea name="address"><?= \App\Core\Security::escape((string) ($settingsForm['address'] ?? '')); ?></textarea>
        </label>

        <label>
            Operator email
            <input type="email" name="operator_email" value="<?= \App\Core\Security::escape((string) ($settingsForm['operator_email'] ?? '')); ?>">
        </label>

        <div class="inline-actions">
            <button type="submit">Save settings</button>
        </div>
    </form>
</section>
