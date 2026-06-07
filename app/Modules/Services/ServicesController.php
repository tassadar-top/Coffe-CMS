<?php

declare(strict_types=1);

namespace App\Modules\Services;

use App\Core\Controller;

final class ServicesController extends Controller
{
    public function publicIndex(): void
    {
        $this->ensureModuleEnabled('services');
        $this->view('Services/Views/public-index');
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('services');
        $this->view('Services/Views/index');
    }
}
