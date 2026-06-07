<?php

declare(strict_types=1);

namespace App\Modules\Gallery;

use App\Core\Controller;

final class GalleryController extends Controller
{
    public function publicIndex(): void
    {
        $this->ensureModuleEnabled('gallery');
        $this->view('Gallery/Views/public-index');
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('gallery');
        $this->view('Gallery/Views/index');
    }
}
