<?php

declare(strict_types=1);

namespace App\Modules\Pricing;

use App\Core\Controller;

final class PricingController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('pricing');
        $this->view('Pricing/Views/index');
    }
}
