<?php

declare(strict_types=1);

namespace App\Modules\Forms;

use App\Core\Controller;

final class FormsController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('forms');
        $this->view('Forms/Views/index');
    }
}
