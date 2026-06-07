<section class="admin-card stack">
    <div>
        <p class="meta">Theme library</p>
        <h1>Themes for <?= \App\Core\Security::escape($profile['name'] ?? 'active profile'); ?></h1>
    </div>

    <form class="theme-grid" method="post" action="<?= base_url($adminPath . '/themes/update'); ?>">
        <input type="hidden" name="<?= \App\Core\Security::escape($csrfKey); ?>" value="<?= \App\Core\Security::escape($csrf); ?>">

        <?php foreach ($themes as $theme): ?>
            <?php if (!isset($availableThemeConfigs[$theme['folder']])) { continue; } ?>
            <?php $themeConfig = $availableThemeConfigs[$theme['folder']]; ?>
            <label class="theme-option <?= (int) $theme['is_active'] === 1 ? 'is-active' : ''; ?>">
                <input type="radio" name="theme_id" value="<?= (int) $theme['id']; ?>" <?= (int) $theme['is_active'] === 1 ? 'checked' : ''; ?>>
                <img class="theme-preview" src="<?= base_url('theme-assets/' . $theme['folder'] . '/' . ($themeConfig['preview'] ?? 'preview.svg')); ?>" alt="<?= \App\Core\Security::escape($theme['name']); ?>">
                <div class="theme-option-body">
                    <div class="inline-actions" style="justify-content: space-between; align-items: center;">
                        <strong><?= \App\Core\Security::escape($theme['name']); ?></strong>
                        <?php if ((int) $theme['is_active'] === 1): ?>
                            <span class="small">Active</span>
                        <?php endif; ?>
                    </div>
                    <div class="small"><?= \App\Core\Security::escape($theme['folder']); ?></div>
                    <p class="small"><?= \App\Core\Security::escape($themeConfig['description'] ?? ''); ?></p>
                    <div class="small">Layout: <?= \App\Core\Security::escape($themeConfig['layout'] ?? 'default'); ?></div>
                </div>
            </label>
        <?php endforeach; ?>

        <div>
            <button type="submit">Save theme</button>
        </div>
    </form>
</section>
