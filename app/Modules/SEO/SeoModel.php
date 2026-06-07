<?php

declare(strict_types=1);

namespace App\Modules\SEO;

use App\Core\Model;

final class SeoModel extends Model
{
    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM seo_meta ORDER BY entity_type ASC, entity_id ASC')->fetchAll();
    }

    public function updateMany(array $rows): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE seo_meta SET meta_title = :meta_title, meta_description = :meta_description, canonical_url = :canonical_url, robots = :robots WHERE id = :id'
        );

        foreach ($rows as $row) {
            $stmt->execute($row);
        }
    }
}
