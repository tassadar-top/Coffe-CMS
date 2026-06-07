<?php

declare(strict_types=1);

namespace App\Modules\Account;

use App\Core\Controller;

final class AccountController extends Controller
{
    public function publicIndex(): void
    {
        $this->ensureModuleEnabled('account');
        $this->view('Account/Views/public-index');
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('account');
        $this->view('Account/Views/index');
    }
}
