<?php

declare(strict_types=1);

namespace App\Modules\Settings;

use App\Core\Model;

final class SettingsModel extends Model
{
    public function all(): array
    {
        $rows = $this->pdo->query('SELECT setting_key, setting_value FROM settings ORDER BY setting_key ASC')->fetchAll();
        $settings = [];

        foreach ($rows as $row) {
            $settings[(string) $row['setting_key']] = (string) ($row['setting_value'] ?? '');
        }

        return $settings;
    }

    public function saveMany(array $settings): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO settings (setting_key, setting_value) VALUES (:setting_key, :setting_value)
             ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)'
        );

        foreach ($settings as $key => $value) {
            $stmt->execute([
                'setting_key' => (string) $key,
                'setting_value' => (string) $value,
            ]);
        }
    }
}
