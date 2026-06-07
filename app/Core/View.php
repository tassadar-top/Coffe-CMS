<?php

declare(strict_types=1);

namespace App\Core;

use App\Services\ThemeManager;

final class View
{
    public static function render(string $template, array $data = [], ?string $layout = 'layout'): void
    {
        extract($data, EXTR_SKIP);
        $templatePath = APP_PATH . '/Modules/' . str_replace('.', '/', $template) . '.php';

        if (!is_file($templatePath)) {
            throw new \RuntimeException(sprintf('View "%s" not found.', $template));
        }

        ob_start();
        require $templatePath;
        $content = ob_get_clean();

        if ($layout === null) {
            echo $content;
            return;
        }

        if ($layout === 'layout' && !str_starts_with($template, 'Admin/')) {
            /** @var array{5?: ThemeManager} $container */
            $container = $GLOBALS['coffee_cms_container'] ?? [];
            $themeManager = $container[5] ?? null;

            if ($themeManager instanceof ThemeManager) {
                $normalized = str_replace('\\', '/', $template);
                $parts = explode('/', $normalized);
                $moduleDir = strtolower($parts[0] ?? '');
                $viewFile = basename($normalized) . '.php';

                $themeTemplate = $themeManager->viewPath($moduleDir . '/' . $viewFile);
                if ($themeTemplate === null) {
                    $themeTemplate = $themeManager->viewPath($viewFile);
                }
                if ($themeTemplate !== null) {
                    ob_start();
                    require $themeTemplate;
                    $content = ob_get_clean();
                }

                $themeLayout = $themeManager->viewPath('layout.php');
                if ($themeLayout !== null) {
                    require $themeLayout;
                    return;
                }
            }
        }

        require APP_PATH . '/Modules/Admin/Views/' . $layout . '.php';
    }
}
