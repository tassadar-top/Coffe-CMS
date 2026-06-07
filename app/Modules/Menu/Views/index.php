<section class="admin-card">
    <h1>Catalog</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Showcase</th>
                <th>Buyable</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= \App\Core\Security::escape($item['title']); ?></td>
                    <td><?= \App\Core\Security::escape((string) $item['category_title']); ?></td>
                    <td><?= \App\Core\Security::escape($item['price']); ?></td>
                    <td><?= (int) ($item['is_showcase'] ?? 0) === 1 ? 'Yes' : 'No'; ?></td>
                    <td><?= (int) ($item['is_purchasable'] ?? 0) === 1 ? 'Yes' : 'No'; ?></td>
                    <td><a class="button secondary" href="<?= base_url($adminPath . '/menu/edit?id=' . (int) $item['id']); ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
