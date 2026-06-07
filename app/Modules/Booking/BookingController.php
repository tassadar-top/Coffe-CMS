<?php

declare(strict_types=1);

namespace App\Modules\Booking;

use App\Core\Controller;

final class BookingController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('booking');
        $this->view('Booking/Views/index');
    }
}
