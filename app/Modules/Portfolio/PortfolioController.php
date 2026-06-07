<?php

declare(strict_types=1);

namespace App\Modules\Portfolio;

use App\Core\Controller;

final class PortfolioController extends Controller
{
    public function publicIndex(): void
    {
        $this->ensureModuleEnabled('portfolio');
        $this->view('Portfolio/Views/public-index');
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('portfolio');
        $this->view('Portfolio/Views/index');
    }
}
