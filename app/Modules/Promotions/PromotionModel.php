<?php

declare(strict_types=1);

namespace App\Modules\Promotions;

use App\Core\Model;

final class PromotionModel extends Model
{
    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM promotions ORDER BY starts_at DESC, id DESC')->fetchAll();
    }

    public function active(): array
    {
        return $this->pdo->query("SELECT * FROM promotions WHERE status = 'active' ORDER BY starts_at DESC")->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM promotions WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $promotion = $stmt->fetch();

        return $promotion ?: null;
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE promotions SET title = :title, description = :description, image = :image, image_alt = :image_alt, starts_at = :starts_at, ends_at = :ends_at, status = :status WHERE id = :id'
        );
        $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
            'image_alt' => $data['image_alt'],
            'starts_at' => $data['starts_at'],
            'ends_at' => $data['ends_at'],
            'status' => $data['status'],
        ]);
    }
}
