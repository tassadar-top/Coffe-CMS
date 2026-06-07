<?php

declare(strict_types=1);

namespace App\Modules\Pages;

use App\Core\Controller;
use App\Core\Security;

final class PageController extends Controller
{
    private PageModel $pages;

    public function __construct()
    {
        parent::__construct();
        $this->pages = new PageModel($this->database);
    }

    public function home(): void
    {
        $profile = $this->profiles->current();

        $this->view('Pages/Views/home', [
            'page' => $this->pages->findBySlug('home'),
            'about' => $this->pages->findBySlug('about'),
            'contacts' => $this->pages->findBySlug('contacts'),
            'demoPages' => $profile['demo_pages'] ?? [],
        ]);
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->view('Pages/Views/index', [
            'pages' => $this->pages->all(),
        ]);
    }

    public function edit(): void
    {
        $this->requireAdmin();
        $page = $this->guardRecord(
            $this->pages->find((int) ($_GET['id'] ?? 0)),
            'Page not found.',
            $this->adminPath() . '/pages'
        );

        $this->view('Pages/Views/edit', $this->withCsrf([
            'page' => $page,
        ]));
    }

    public function update(): void
    {
        $this->requireAdmin();
        Security::verifyCsrf($this->csrfKey());
        $page = $this->guardRecord(
            $this->pages->find((int) ($_POST['id'] ?? 0)),
            'Page not found.',
            $this->adminPath() . '/pages'
        );

        $this->runActionOrFlash(function () use ($page): void {
            $imagePath = $this->uploadImageAsset(
                'image',
                'pages',
                $page['image_path'],
                !empty($_POST['remove_image'])
            );

            $this->pages->update((int) $page['id'], [
                'title' => Security::sanitizeText($_POST['title'] ?? ''),
                'slug' => Security::sanitizeText($_POST['slug'] ?? ''),
                'content' => Security::sanitizeText($_POST['content'] ?? ''),
                'image_path' => $imagePath,
                'image_alt' => Security::sanitizeText($_POST['image_alt'] ?? ''),
            ]);
        }, 'Page content and image updated.', $this->adminPath() . '/pages/edit?id=' . (int) $page['id']);
    }
}
