<?php

declare(strict_types=1);

namespace App\Modules\Delivery;

use App\Core\Controller;

final class DeliveryController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('delivery');
        $this->view('Delivery/README');
    }
}
