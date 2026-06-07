<?php

declare(strict_types=1);

namespace App\Services;

use App\Core\Config;
use App\Core\Database;
use PDO;

final class ThemeManager
{
    private ?PDO $pdo = null;

    public function __construct(
        private Config $config,
        private Database $database,
        private BusinessProfileManager $profiles
    ) {
    }

    public function activeThemeKey(): string
    {
        try {
            $pdo = $this->pdo();
            $theme = $pdo->query('SELECT folder FROM themes WHERE is_active = 1 LIMIT 1')->fetchColumn();
            if (is_string($theme) && $theme !== '') {
                return $theme;
            }
        } catch (\Throwable) {
        }

        return $this->profiles->defaultTheme();
    }

    public function activeThemeConfig(): array
    {
        $path = CONFIG_PATH . '/themes/' . $this->activeThemeKey() . '.php';

        return is_file($path) ? require $path : [];
    }

    public function viewPath(string $view): ?string
    {
        $path = BASE_PATH . '/themes/' . $this->activeThemeKey() . '/' . ltrim($view, '/');

        return is_file($path) ? $path : null;
    }

    public function assetUrl(string $path): string
    {
        return base_url('theme-assets/' . $this->activeThemeKey() . '/' . ltrim($path, '/'));
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
