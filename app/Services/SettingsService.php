<?php

declare(strict_types=1);

namespace App\Services;

use App\Core\Config;
use App\Core\Database;
use PDO;

final class SettingsService
{
    private ?PDO $pdo = null;
    private ?array $cache = null;

    public function __construct(
        private Config $config,
        private Database $database
    ) {
    }

    public function all(): array
    {
        if (is_array($this->cache)) {
            return $this->cache;
        }

        $defaults = [
            'business_name' => (string) $this->config->get('config.app.name', 'Coffee CMS'),
            'tagline' => '',
            'logo_path' => '',
            'logo_alt' => '',
            'contact_phone' => '',
            'contact_email' => '',
            'address' => '',
            'operator_email' => '',
        ];

        try {
            $rows = $this->pdo()
                ->query('SELECT setting_key, setting_value FROM settings')
                ->fetchAll();

            foreach ($rows as $row) {
                $defaults[(string) $row['setting_key']] = (string) ($row['setting_value'] ?? '');
            }
        } catch (\Throwable) {
        }

        $this->cache = $defaults;

        return $this->cache;
    }

    public function get(string $key, string $default = ''): string
    {
        $settings = $this->all();

        return array_key_exists($key, $settings) ? (string) $settings[$key] : $default;
    }

    public function branding(): array
    {
        $settings = $this->all();
        $logoPath = trim((string) ($settings['logo_path'] ?? ''));

        return [
            'business_name' => (string) ($settings['business_name'] ?? $this->config->get('config.app.name', 'Coffee CMS')),
            'tagline' => (string) ($settings['tagline'] ?? ''),
            'logo_path' => $logoPath,
            'logo_url' => $logoPath !== '' ? public_upload_url($logoPath) : null,
            'logo_alt' => (string) ($settings['logo_alt'] ?? ''),
            'contact_phone' => (string) ($settings['contact_phone'] ?? ''),
            'contact_email' => (string) ($settings['contact_email'] ?? ''),
            'address' => (string) ($settings['address'] ?? ''),
            'operator_email' => (string) ($settings['operator_email'] ?? ''),
        ];
    }

    public function clearCache(): void
    {
        $this->cache = null;
    }

    private function pdo(): PDO
    {
        if ($this->pdo instanceof PDO) {
            return $this->pdo;
        }

        $this->pdo = $this->database->connection();

        return $this->pdo;
    }
}
