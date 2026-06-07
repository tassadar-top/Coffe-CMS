<?php

declare(strict_types=1);

namespace App\Services;

final class ModuleAccessService
{
    public function __construct(private BusinessProfileManager $profiles)
    {
    }

    public function ensureEnabled(string $module): void
    {
        if ($this->profiles->hasModule($module)) {
            return;
        }

        http_response_code(403);
        require APP_PATH . '/Modules/Admin/Views/403.php';
        exit;
    }
}
