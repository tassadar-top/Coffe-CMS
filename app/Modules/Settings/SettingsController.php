<?php

declare(strict_types=1);

namespace App\Modules\Settings;

use App\Core\Controller;
use App\Core\Security;

final class SettingsController extends Controller
{
    private SettingsModel $settingsModel;

    public function __construct()
    {
        parent::__construct();
        $this->settingsModel = new SettingsModel($this->database);
    }

    public function index(): void
    {
        $this->requireAdmin();

        $this->view('Settings/Views/index', $this->withCsrf([
            'settingsForm' => array_merge($this->settings->all(), [
                'business_name' => $this->settings->get('business_name', (string) $this->config->get('config.app.name', 'Coffee CMS')),
                'tagline' => $this->settings->get('tagline'),
                'logo_path' => $this->settings->get('logo_path'),
                'logo_alt' => $this->settings->get('logo_alt'),
                'contact_phone' => $this->settings->get('contact_phone'),
                'contact_email' => $this->settings->get('contact_email'),
                'address' => $this->settings->get('address'),
                'operator_email' => $this->settings->get('operator_email'),
            ]),
        ]));
    }

    public function update(): void
    {
        $this->requireAdmin();
        Security::verifyCsrf($this->csrfKey());

        $currentLogo = $this->settings->get('logo_path');

        $this->runActionOrFlash(function () use ($currentLogo): void {
            $logoPath = $this->uploadImageAsset(
                'logo',
                'settings',
                $currentLogo,
                !empty($_POST['remove_logo'])
            );

            $this->settingsModel->saveMany([
                'business_name' => Security::sanitizeText($_POST['business_name'] ?? ''),
                'tagline' => Security::sanitizeText($_POST['tagline'] ?? ''),
                'logo_path' => $logoPath ?? '',
                'logo_alt' => Security::sanitizeText($_POST['logo_alt'] ?? ''),
                'contact_phone' => Security::sanitizeText($_POST['contact_phone'] ?? ''),
                'contact_email' => Security::sanitizeText($_POST['contact_email'] ?? ''),
                'address' => Security::sanitizeText($_POST['address'] ?? ''),
                'operator_email' => Security::sanitizeText($_POST['operator_email'] ?? ''),
            ]);

            $this->settings->clearCache();
        }, 'Settings updated.', $this->adminPath() . '/settings');
    }
}
