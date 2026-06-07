<?php

declare(strict_types=1);

namespace App\Modules\Themes;

use App\Core\Controller;
use App\Core\Security;

final class ThemeController extends Controller
{
    private ThemeModel $themes;

    public function __construct()
    {
        parent::__construct();
        $this->themes = new ThemeModel($this->database);
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->view('Themes/Views/index', $this->withCsrf([
            'themes' => $this->themes->all(),
            'availableThemeConfigs' => $this->profiles->themesForCurrentProfile(),
        ]));
    }

    public function update(): void
    {
        $this->requireAdmin();
        Security::verifyCsrf($this->csrfKey());
        $theme = $this->themes->find((int) ($_POST['theme_id'] ?? 0));
        $allowedThemes = array_keys($this->profiles->themesForCurrentProfile());

        if (!$theme || !in_array($theme['folder'], $allowedThemes, true)) {
            $this->redirectWithFlash('error', 'This theme is not available for the active business profile.', $this->adminPath() . '/themes');
        }

        $this->themes->activate((int) $theme['id']);
        $this->redirectWithFlash('success', 'Theme updated.', $this->adminPath() . '/themes');
    }
}
