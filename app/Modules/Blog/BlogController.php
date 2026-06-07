<?php

declare(strict_types=1);

namespace App\Modules\Blog;

use App\Core\Controller;

final class BlogController extends Controller
{
    public function publicIndex(): void
    {
        $this->ensureModuleEnabled('blog');
        $this->view('Blog/Views/public-index');
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('blog');
        $this->view('Blog/Views/index');
    }
}
