<?php

declare(strict_types=1);

namespace App\Modules\Menu;

use App\Core\Controller;
use App\Core\Security;

final class MenuController extends Controller
{
    private MenuModel $menu;

    public function __construct()
    {
        parent::__construct();
        $this->menu = new MenuModel($this->database);
    }

    public function publicIndex(): void
    {
        $this->ensureModuleEnabled('menu');
        $this->view('Menu/Views/public-index', [
            'items' => $this->menu->publicCatalog(),
        ]);
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('menu');
        $this->view('Menu/Views/index', [
            'items' => $this->menu->all(),
        ]);
    }

    public function edit(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('menu');
        $item = $this->guardRecord(
            $this->menu->find((int) ($_GET['id'] ?? 0)),
            'Catalog item not found.',
            $this->adminPath() . '/menu'
        );

        $this->view('Menu/Views/edit', $this->withCsrf([
            'item' => $item,
            'categories' => $this->menu->categories(),
        ]));
    }

    public function update(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('menu');
        Security::verifyCsrf($this->csrfKey());
        $item = $this->guardRecord(
            $this->menu->find((int) ($_POST['id'] ?? 0)),
            'Catalog item not found.',
            $this->adminPath() . '/menu'
        );

        $this->runActionOrFlash(function () use ($item): void {
            $imagePath = $this->uploadImageAsset(
                'image',
                'menu',
                $item['image'],
                !empty($_POST['remove_image'])
            );

            $this->menu->update((int) $item['id'], [
                'category_id' => (int) ($_POST['category_id'] ?? $item['category_id']),
                'title' => Security::sanitizeText($_POST['title'] ?? ''),
                'description' => Security::sanitizeText($_POST['description'] ?? ''),
                'price' => (string) ($_POST['price'] ?? ''),
                'image' => $imagePath,
                'image_alt' => Security::sanitizeText($_POST['image_alt'] ?? ''),
                'status' => Security::sanitizeText($_POST['status'] ?? 'active'),
                'is_popular' => empty($_POST['is_popular']) ? 0 : 1,
                'is_new' => empty($_POST['is_new']) ? 0 : 1,
                'is_showcase' => empty($_POST['is_showcase']) ? 0 : 1,
                'is_purchasable' => empty($_POST['is_purchasable']) ? 0 : 1,
                'sort_order' => (int) ($_POST['sort_order'] ?? 0),
            ]);
        }, 'Catalog item updated.', $this->adminPath() . '/menu/edit?id=' . (int) $item['id']);
    }
}
