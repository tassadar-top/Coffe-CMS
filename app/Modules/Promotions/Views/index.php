<section class="admin-card">
    <h1>Promotions</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promotions as $promotion): ?>
                <tr>
                    <td><?= \App\Core\Security::escape($promotion['title']); ?></td>
                    <td><?= \App\Core\Security::escape($promotion['description']); ?></td>
                    <td><?= !empty($promotion['image']) ? 'Present' : 'Missing'; ?></td>
                    <td><?= \App\Core\Security::escape($promotion['status']); ?></td>
                    <td><a class="button secondary" href="<?= base_url($adminPath . '/promotions/edit?id=' . (int) $promotion['id']); ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
