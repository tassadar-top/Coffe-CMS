<?php

declare(strict_types=1);

namespace App\Modules\Users;

use App\Core\Controller;

final class UsersController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('users');
        $this->view('Users/Views/index');
    }
}
