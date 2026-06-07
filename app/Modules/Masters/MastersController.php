<?php

declare(strict_types=1);

namespace App\Modules\Masters;

use App\Core\Controller;

final class MastersController extends Controller
{
    public function publicIndex(): void
    {
        $this->ensureModuleEnabled('masters');
        $this->view('Masters/Views/public-index');
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('masters');
        $this->view('Masters/Views/index');
    }
}
