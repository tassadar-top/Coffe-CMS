<section class="section">
    <div class="admin-card" style="margin-bottom: 20px;">
        <p class="meta">Active business profile</p>
        <h1><?= \App\Core\Security::escape($profile['name'] ?? 'Business Profile'); ?></h1>
        <p><?= \App\Core\Security::escape($profile['description'] ?? ''); ?></p>
    </div>
    <div class="grid three">
        <div class="admin-card">
            <p class="meta">Pages</p>
            <h2><?= (int) $stats['pages']; ?></h2>
        </div>
        <div class="admin-card">
            <p class="meta">Catalog items</p>
            <h2><?= (int) $stats['menu_items']; ?></h2>
        </div>
        <div class="admin-card">
            <p class="meta">Active theme</p>
            <h2><?= \App\Core\Security::escape((string) $stats['theme']); ?></h2>
        </div>
    </div>
</section>

<section class="admin-layout">
    <aside class="admin-sidebar admin-card stack">
        <?php foreach ($adminSections as $section): ?>
            <a href="<?= base_url($adminPath . $section['path']); ?>"><?= \App\Core\Security::escape($section['title']); ?></a>
        <?php endforeach; ?>
        <form method="post" action="<?= base_url($adminPath . '/logout'); ?>">
            <input type="hidden" name="<?= \App\Core\Security::escape($csrfKey); ?>" value="<?= \App\Core\Security::escape($csrf); ?>">
            <button type="submit">Sign out</button>
        </form>
    </aside>

    <div class="admin-card">
        <h2>Recent login attempts</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>IP</th>
                    <th>Status</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stats['attempts'] as $attempt): ?>
                    <tr>
                        <td><?= \App\Core\Security::escape($attempt['username']); ?></td>
                        <td><?= \App\Core\Security::escape($attempt['ip']); ?></td>
                        <td><?= (int) $attempt['success'] === 1 ? 'Success' : 'Failed'; ?></td>
                        <td><?= \App\Core\Security::escape($attempt['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
