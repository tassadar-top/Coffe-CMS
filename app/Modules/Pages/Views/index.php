<section class="admin-card">
    <div class="inline-actions" style="justify-content: space-between;">
        <div>
            <p class="meta">Site pages</p>
            <h1>Edit page content and images</h1>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Image</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $page): ?>
                <tr>
                    <td><?= (int) $page['id']; ?></td>
                    <td><?= \App\Core\Security::escape($page['title']); ?></td>
                    <td><?= \App\Core\Security::escape($page['slug']); ?></td>
                    <td><?= !empty($page['image_path']) ? 'Present' : 'Missing'; ?></td>
                    <td><a class="button secondary" href="<?= base_url($adminPath . '/pages/edit?id=' . (int) $page['id']); ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
