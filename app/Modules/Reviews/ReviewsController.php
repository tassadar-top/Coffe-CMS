<?php

declare(strict_types=1);

namespace App\Modules\Reviews;

use App\Core\Controller;

final class ReviewsController extends Controller
{
    public function publicIndex(): void
    {
        $this->ensureModuleEnabled('reviews');
        $this->view('Reviews/Views/public-index');
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('reviews');
        $this->view('Reviews/Views/index');
    }
}
