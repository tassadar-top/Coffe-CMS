<?php

declare(strict_types=1);

namespace App\Services;

use App\Core\Config;

final class BusinessProfileManager
{
    private array $profiles = [];
    private array $themes = [];

    public function __construct(private Config $config)
    {
        $this->profiles = $this->loadConfigs(CONFIG_PATH . '/business_profiles');
        $this->themes = $this->loadConfigs(CONFIG_PATH . '/themes');
    }

    public function currentKey(): string
    {
        return (string) $this->config->get('config.app.business_profile', 'coffee_shop');
    }

    public function current(): array
    {
        return $this->profiles[$this->currentKey()] ?? reset($this->profiles) ?: [];
    }

    public function all(): array
    {
        return $this->profiles;
    }

    public function modules(): array
    {
        return $this->current()['modules'] ?? [];
    }

    public function hasModule(string $module): bool
    {
        return in_array($module, $this->modules(), true);
    }

    public function themesForCurrentProfile(): array
    {
        $allowed = $this->current()['themes'] ?? [];
        $result = [];

        foreach ($allowed as $themeKey) {
            if (isset($this->themes[$themeKey])) {
                $result[$themeKey] = $this->themes[$themeKey];
            }
        }

        return $result;
    }

    public function defaultTheme(): string
    {
        return (string) ($this->current()['default_theme'] ?? 'coffee-modern');
    }

    public function adminSections(): array
    {
        $sections = [
            'pages' => ['title' => 'Pages', 'path' => '/pages'],
            'menu' => ['title' => 'Catalog', 'path' => '/menu'],
            'services' => ['title' => 'Services', 'path' => '/services'],
            'masters' => ['title' => 'Masters', 'path' => '/masters'],
            'booking' => ['title' => 'Booking', 'path' => '/booking'],
            'pricing' => ['title' => 'Pricing', 'path' => '/pricing'],
            'portfolio' => ['title' => 'Portfolio', 'path' => '/portfolio'],
            'promotions' => ['title' => 'Promotions', 'path' => '/promotions'],
            'gallery' => ['title' => 'Gallery', 'path' => '/gallery'],
            'reviews' => ['title' => 'Reviews', 'path' => '/reviews'],
            'contacts' => ['title' => 'Contacts', 'path' => '/contacts'],
            'forms' => ['title' => 'Forms', 'path' => '/forms'],
            'blog' => ['title' => 'Blog', 'path' => '/blog'],
            'seo' => ['title' => 'SEO', 'path' => '/seo'],
            'settings' => ['title' => 'Settings', 'path' => '/settings'],
            'themes' => ['title' => 'Themes', 'path' => '/themes'],
            'users' => ['title' => 'Users', 'path' => '/users'],
            'security' => ['title' => 'Security', 'path' => '/security'],
            'delivery' => ['title' => 'Delivery', 'path' => '/delivery'],
            'orders' => ['title' => 'Orders', 'path' => '/orders'],
            'account' => ['title' => 'Account', 'path' => '/account'],
        ];

        $result = [];
        foreach ($this->modules() as $module) {
            if (isset($sections[$module])) {
                $result[$module] = $sections[$module];
            }
        }

        $result['settings'] = $sections['settings'];

        return $result;
    }

    private function loadConfigs(string $directory): array
    {
        $items = [];
        foreach (glob($directory . '/*.php') ?: [] as $file) {
            $items[basename($file, '.php')] = require $file;
        }

        return $items;
    }
}
