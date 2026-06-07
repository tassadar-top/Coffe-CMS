<?php

declare(strict_types=1);

namespace App\Modules\Themes;

use App\Core\Model;

final class ThemeModel extends Model
{
    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM themes ORDER BY id ASC')->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM themes WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $theme = $stmt->fetch();

        return $theme ?: null;
    }

    public function activate(int $id): void
    {
        $this->pdo->exec('UPDATE themes SET is_active = 0');
        $stmt = $this->pdo->prepare('UPDATE themes SET is_active = 1 WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
