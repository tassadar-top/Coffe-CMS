<?php

declare(strict_types=1);

namespace App\Core;

use App\Services\BusinessProfileManager;
use App\Services\ModuleAccessService;
use App\Services\SettingsService;
use App\Services\ThemeManager;
use Throwable;

abstract class Controller
{
    protected Config $config;
    protected Database $database;
    protected BusinessProfileManager $profiles;
    protected ModuleAccessService $moduleAccess;
    protected ThemeManager $themes;
    protected SettingsService $settings;

    public function __construct()
    {
        static $container;

        if ($container === null) {
            if (!isset($GLOBALS['coffee_cms_container'])) {
                require BASE_PATH . '/bootstrap/app.php';
            }

            [, $config, $database, $profiles, $moduleAccess, $themes, $settings] = $GLOBALS['coffee_cms_container'];
            $container = [$config, $database, $profiles, $moduleAccess, $themes, $settings];
        }

        [$this->config, $this->database, $this->profiles, $this->moduleAccess, $this->themes, $this->settings] = $container;
    }

    protected function view(string $template, array $data = [], ?string $layout = 'layout'): void
    {
        $data = array_merge([
            'profile' => $this->profiles->current(),
            'adminSections' => $this->profiles->adminSections(),
            'adminPath' => (string) $this->config->get('config.app.admin_path', 'secret-admin'),
            'activeTheme' => $this->themes->activeThemeKey(),
            'activeThemeConfig' => $this->themes->activeThemeConfig(),
            'siteSettings' => $this->settings->all(),
            'branding' => $this->settings->branding(),
        ], $data);

        View::render($template, $data, $layout);
    }

    protected function redirect(string $path): never
    {
        header('Location: ' . base_url($path));
        exit;
    }

    protected function adminPath(): string
    {
        return (string) $this->config->get('config.app.admin_path', 'secret-admin');
    }

    protected function csrfKey(): string
    {
        return (string) $this->config->get('security.csrf_key', '_token');
    }

    protected function requireAdmin(): void
    {
        Auth::requireAuth($this->adminPath() . '/login');
    }

    protected function ensureModuleEnabled(string $module): void
    {
        $this->moduleAccess->ensureEnabled($module);
    }

    protected function flash(string $type, string $message): void
    {
        $_SESSION['flash_' . $type] = $message;
    }

    protected function redirectWithFlash(string $type, string $message, string $path): never
    {
        $this->flash($type, $message);
        $this->redirect($path);
    }

    protected function withCsrf(array $data = []): array
    {
        return array_merge($data, [
            'csrf' => Security::csrfToken($this->csrfKey()),
            'csrfKey' => $this->csrfKey(),
        ]);
    }

    protected function uploadImageAsset(
        string $field,
        string $directory,
        ?string $currentPath,
        bool $removeRequested = false
    ): ?string {
        $imagePath = $currentPath;

        if ($removeRequested && $imagePath) {
            Security::deleteUpload($imagePath);
            $imagePath = null;
        }

        $newImage = Security::handleImageUpload(
            $field,
            $directory,
            (array) $this->config->get('security.allowed_image_extensions', []),
            (array) $this->config->get('security.allowed_image_mime_types', []),
            (int) $this->config->get('security.max_upload_size', 3145728)
        );

        if ($newImage !== null) {
            Security::deleteUpload($imagePath);
            $imagePath = $newImage;
        }

        return $imagePath;
    }

    protected function guardRecord(mixed $record, string $message, string $redirectPath): mixed
    {
        if ($record) {
            return $record;
        }

        $this->redirectWithFlash('error', $message, $redirectPath);
    }

    protected function runActionOrFlash(callable $callback, string $successMessage, string $redirectPath): never
    {
        try {
            $callback();
            $this->flash('success', $successMessage);
        } catch (Throwable $exception) {
            $this->flash('error', $exception->getMessage());
        }

        $this->redirect($redirectPath);
    }
}
