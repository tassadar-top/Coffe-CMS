<?php

declare(strict_types=1);

namespace App\Core;

use App\Modules\Admin\AdminController;
use App\Modules\Booking\BookingController;
use App\Modules\Contacts\ContactsController;
use App\Modules\Gallery\GalleryController;
use App\Modules\Menu\MenuController;
use App\Modules\Masters\MastersController;
use App\Modules\Orders\OrdersController;
use App\Modules\Pages\PageController;
use App\Modules\Portfolio\PortfolioController;
use App\Modules\Promotions\PromotionController;
use App\Modules\Pricing\PricingController;
use App\Modules\Reviews\ReviewsController;
use App\Modules\Account\AccountController;
use App\Modules\SEO\SeoController;
use App\Modules\Services\ServicesController;
use App\Modules\Themes\ThemeController;
use App\Modules\Blog\BlogController;
use App\Modules\Forms\FormsController;
use App\Modules\Users\UsersController;
use App\Modules\Security\SecurityController;
use App\Modules\Delivery\DeliveryController;
use App\Services\BusinessProfileManager;
use App\Services\ModuleAccessService;

final class ModuleManager
{
    public function __construct(
        private Router $router,
        private Database $database,
        private Config $config,
        private BusinessProfileManager $profiles,
        private ModuleAccessService $moduleAccess
    ) {
    }

    public function registerDefaultModules(): void
    {
        $adminPath = $this->config->get('config.app.admin_path', 'secret-admin');

        $this->router->get('/', [PageController::class, 'home']);
        if ($this->profiles->hasModule('menu')) {
            $this->router->get('/menu', [MenuController::class, 'publicIndex']);
        }
        if ($this->profiles->hasModule('promotions')) {
            $this->router->get('/promotions', [PromotionController::class, 'publicIndex']);
        }
        if ($this->profiles->hasModule('services')) {
            $this->router->get('/services', [ServicesController::class, 'publicIndex']);
        }
        if ($this->profiles->hasModule('masters')) {
            $this->router->get('/masters', [MastersController::class, 'publicIndex']);
        }
        if ($this->profiles->hasModule('portfolio')) {
            $this->router->get('/portfolio', [PortfolioController::class, 'publicIndex']);
        }
        if ($this->profiles->hasModule('reviews')) {
            $this->router->get('/reviews', [ReviewsController::class, 'publicIndex']);
        }
        if ($this->profiles->hasModule('gallery')) {
            $this->router->get('/gallery', [GalleryController::class, 'publicIndex']);
        }
        if ($this->profiles->hasModule('contacts')) {
            $this->router->get('/contacts', [ContactsController::class, 'publicIndex']);
        }
        if ($this->profiles->hasModule('blog')) {
            $this->router->get('/blog', [BlogController::class, 'publicIndex']);
        }
        if ($this->profiles->hasModule('account')) {
            $this->router->get('/account', [AccountController::class, 'publicIndex']);
        }
        $this->router->get('/admin', [AdminController::class, 'honeypot']);

        $this->router->get("/{$adminPath}/login", [AdminController::class, 'loginForm']);
        $this->router->post("/{$adminPath}/login", [AdminController::class, 'login']);
        $this->router->post("/{$adminPath}/logout", [AdminController::class, 'logout']);
        $this->router->get("/{$adminPath}", [AdminController::class, 'dashboard']);

        $this->router->get("/{$adminPath}/pages", [PageController::class, 'index']);
        $this->router->get("/{$adminPath}/pages/edit", [PageController::class, 'edit']);
        $this->router->post("/{$adminPath}/pages/update", [PageController::class, 'update']);

        if ($this->profiles->hasModule('menu')) {
            $this->router->get("/{$adminPath}/menu", [MenuController::class, 'index']);
            $this->router->get("/{$adminPath}/menu/edit", [MenuController::class, 'edit']);
            $this->router->post("/{$adminPath}/menu/update", [MenuController::class, 'update']);
        }

        if ($this->profiles->hasModule('promotions')) {
            $this->router->get("/{$adminPath}/promotions", [PromotionController::class, 'index']);
            $this->router->get("/{$adminPath}/promotions/edit", [PromotionController::class, 'edit']);
            $this->router->post("/{$adminPath}/promotions/update", [PromotionController::class, 'update']);
        }

        if ($this->profiles->hasModule('services')) {
            $this->router->get("/{$adminPath}/services", [ServicesController::class, 'index']);
        }
        if ($this->profiles->hasModule('masters')) {
            $this->router->get("/{$adminPath}/masters", [MastersController::class, 'index']);
        }
        if ($this->profiles->hasModule('booking')) {
            $this->router->get("/{$adminPath}/booking", [BookingController::class, 'index']);
        }
        if ($this->profiles->hasModule('pricing')) {
            $this->router->get("/{$adminPath}/pricing", [PricingController::class, 'index']);
        }
        if ($this->profiles->hasModule('portfolio')) {
            $this->router->get("/{$adminPath}/portfolio", [PortfolioController::class, 'index']);
        }
        if ($this->profiles->hasModule('gallery')) {
            $this->router->get("/{$adminPath}/gallery", [GalleryController::class, 'index']);
        }
        if ($this->profiles->hasModule('reviews')) {
            $this->router->get("/{$adminPath}/reviews", [ReviewsController::class, 'index']);
        }
        if ($this->profiles->hasModule('contacts')) {
            $this->router->get("/{$adminPath}/contacts", [ContactsController::class, 'index']);
        }
        if ($this->profiles->hasModule('forms')) {
            $this->router->get("/{$adminPath}/forms", [FormsController::class, 'index']);
        }
        if ($this->profiles->hasModule('blog')) {
            $this->router->get("/{$adminPath}/blog", [BlogController::class, 'index']);
        }
        if ($this->profiles->hasModule('orders')) {
            $this->router->get("/{$adminPath}/orders", [OrdersController::class, 'index']);
        }
        if ($this->profiles->hasModule('account')) {
            $this->router->get("/{$adminPath}/account", [AccountController::class, 'index']);
        }

        $this->router->get("/{$adminPath}/seo", [SeoController::class, 'index']);
        $this->router->post("/{$adminPath}/seo/update", [SeoController::class, 'update']);

        $this->router->get("/{$adminPath}/themes", [ThemeController::class, 'index']);
        $this->router->post("/{$adminPath}/themes/update", [ThemeController::class, 'update']);

        if ($this->profiles->hasModule('delivery')) {
            $this->router->get("/{$adminPath}/delivery", [DeliveryController::class, 'index']);
        }
        if ($this->profiles->hasModule('users')) {
            $this->router->get("/{$adminPath}/users", [UsersController::class, 'index']);
        }
        if ($this->profiles->hasModule('security')) {
            $this->router->get("/{$adminPath}/security", [SecurityController::class, 'index']);
        }
    }
}
