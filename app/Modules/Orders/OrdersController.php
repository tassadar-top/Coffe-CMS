<?php

declare(strict_types=1);

namespace App\Modules\Orders;

use App\Core\Controller;

final class OrdersController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('orders');
        $this->view('Orders/Views/index');
    }
}
