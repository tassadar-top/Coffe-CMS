<?php

declare(strict_types=1);

namespace App\Modules\Security;

use App\Core\Controller;

final class SecurityController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('security');
        $this->view('Security/Views/index');
    }
}
