<?php

declare(strict_types=1);

namespace App\Modules\Menu;

use App\Core\Model;

final class MenuModel extends Model
{
    public function all(): array
    {
        $sql = 'SELECT menu_items.*, menu_categories.title AS category_title
                FROM menu_items
                LEFT JOIN menu_categories ON menu_categories.id = menu_items.category_id
                ORDER BY menu_categories.sort_order ASC, menu_items.sort_order ASC';

        return $this->pdo->query($sql)->fetchAll();
    }

    public function publicCatalog(): array
    {
        $sql = 'SELECT menu_items.*, menu_categories.title AS category_title
                FROM menu_items
                LEFT JOIN menu_categories ON menu_categories.id = menu_items.category_id
                WHERE menu_items.status = "active" AND menu_items.is_showcase = 1
                ORDER BY menu_categories.sort_order ASC, menu_items.sort_order ASC';

        return $this->pdo->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM menu_items WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch();

        return $item ?: null;
    }

    public function categories(): array
    {
        return $this->pdo->query('SELECT * FROM menu_categories ORDER BY sort_order ASC, title ASC')->fetchAll();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE menu_items
             SET category_id = :category_id, title = :title, description = :description, price = :price, image = :image, image_alt = :image_alt, status = :status, is_popular = :is_popular, is_new = :is_new, is_showcase = :is_showcase, is_purchasable = :is_purchasable, sort_order = :sort_order
             WHERE id = :id'
        );
        $stmt->execute([
            'id' => $id,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $data['image'],
            'image_alt' => $data['image_alt'],
            'status' => $data['status'],
            'is_popular' => $data['is_popular'],
            'is_new' => $data['is_new'],
            'is_showcase' => $data['is_showcase'],
            'is_purchasable' => $data['is_purchasable'],
            'sort_order' => $data['sort_order'],
        ]);
    }
}
