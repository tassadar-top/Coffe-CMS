<?php

declare(strict_types=1);

namespace App\Modules\Contacts;

use App\Core\Controller;

final class ContactsController extends Controller
{
    public function publicIndex(): void
    {
        $this->ensureModuleEnabled('contacts');
        $this->view('Contacts/Views/public-index');
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('contacts');
        $this->view('Contacts/Views/index');
    }
}
