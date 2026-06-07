<?php

declare(strict_types=1);

namespace App\Modules\SEO;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Security;

final class SeoController extends Controller
{
    private SeoModel $seo;

    public function __construct()
    {
        parent::__construct();
        $this->seo = new SeoModel($this->database);
    }

    public function index(): void
    {
        Auth::requireAuth($this->adminPath() . '/login');
        $this->view('SEO/Views/index', [
            'adminPath' => $this->adminPath(),
            'rows' => $this->seo->all(),
            'csrf' => Security::csrfToken($this->csrfKey()),
            'csrfKey' => $this->csrfKey(),
            'adminSections' => $this->profiles->adminSections(),
            'profile' => $this->profiles->current(),
        ]);
    }

    public function update(): void
    {
        Auth::requireAuth($this->adminPath() . '/login');
        Security::verifyCsrf($this->csrfKey());
        $ids = $_POST['id'] ?? [];
        $rows = [];

        foreach ($ids as $index => $id) {
            $rows[] = [
                'id' => (int) $id,
                'meta_title' => Security::sanitizeText($_POST['meta_title'][$index] ?? ''),
                'meta_description' => Security::sanitizeText($_POST['meta_description'][$index] ?? ''),
                'canonical_url' => Security::sanitizeText($_POST['canonical_url'][$index] ?? ''),
                'robots' => Security::sanitizeText($_POST['robots'][$index] ?? 'index,follow'),
            ];
        }

        $this->seo->updateMany($rows);
        $_SESSION['flash_success'] = 'SEO оновлено.';
        $this->redirect($this->adminPath() . '/seo');
    }

    private function adminPath(): string
    {
        return (string) $this->config->get('config.app.admin_path', 'secret-admin');
    }

    private function csrfKey(): string
    {
        return (string) $this->config->get('security.csrf_key', '_token');
    }
}
