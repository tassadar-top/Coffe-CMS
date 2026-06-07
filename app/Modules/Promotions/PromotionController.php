<?php

declare(strict_types=1);

namespace App\Modules\Promotions;

use App\Core\Controller;
use App\Core\Security;

final class PromotionController extends Controller
{
    private PromotionModel $promotions;

    public function __construct()
    {
        parent::__construct();
        $this->promotions = new PromotionModel($this->database);
    }

    public function publicIndex(): void
    {
        $this->ensureModuleEnabled('promotions');
        $this->view('Promotions/Views/public-index', [
            'promotions' => $this->promotions->active(),
        ]);
    }

    public function index(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('promotions');
        $this->view('Promotions/Views/index', [
            'promotions' => $this->promotions->all(),
        ]);
    }

    public function edit(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('promotions');
        $promotion = $this->guardRecord(
            $this->promotions->find((int) ($_GET['id'] ?? 0)),
            'Promotion not found.',
            $this->adminPath() . '/promotions'
        );

        $this->view('Promotions/Views/edit', $this->withCsrf([
            'promotion' => $promotion,
        ]));
    }

    public function update(): void
    {
        $this->requireAdmin();
        $this->ensureModuleEnabled('promotions');
        Security::verifyCsrf($this->csrfKey());
        $promotion = $this->guardRecord(
            $this->promotions->find((int) ($_POST['id'] ?? 0)),
            'Promotion not found.',
            $this->adminPath() . '/promotions'
        );

        $this->runActionOrFlash(function () use ($promotion): void {
            $imagePath = $this->uploadImageAsset(
                'image',
                'promotions',
                $promotion['image'],
                !empty($_POST['remove_image'])
            );

            $this->promotions->update((int) $promotion['id'], [
                'title' => Security::sanitizeText($_POST['title'] ?? ''),
                'description' => Security::sanitizeText($_POST['description'] ?? ''),
                'image' => $imagePath,
                'image_alt' => Security::sanitizeText($_POST['image_alt'] ?? ''),
                'starts_at' => Security::sanitizeText($_POST['starts_at'] ?? ''),
                'ends_at' => Security::sanitizeText($_POST['ends_at'] ?? ''),
                'status' => Security::sanitizeText($_POST['status'] ?? 'inactive'),
            ]);
        }, 'Promotion updated.', $this->adminPath() . '/promotions/edit?id=' . (int) $promotion['id']);
    }
}
