<?php

declare(strict_types=1);

namespace App\Modules\Pages;

use App\Core\Model;

final class PageModel extends Model
{
    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM pages ORDER BY id ASC')->fetchAll();
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM pages WHERE slug = :slug LIMIT 1');
        $stmt->execute(['slug' => $slug]);
        $page = $stmt->fetch();

        return $page ?: null;
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM pages WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $page = $stmt->fetch();

        return $page ?: null;
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE pages SET title = :title, slug = :slug, content = :content, image_path = :image_path, image_alt = :image_alt, updated_at = NOW() WHERE id = :id'
        );
        $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'image_path' => $data['image_path'],
            'image_alt' => $data['image_alt'],
        ]);
    }
}
