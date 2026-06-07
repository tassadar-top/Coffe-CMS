<?php

declare(strict_types=1);

session_name('coffee_cms_session');
session_start();

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('PUBLIC_PATH', BASE_PATH . '/public');
define('STORAGE_PATH', BASE_PATH . '/storage');
define('CONFIG_PATH', BASE_PATH . '/config');

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';

    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $path = APP_PATH . '/' . str_replace('\\', '/', $relative) . '.php';

    if (is_file($path)) {
        require_once $path;
    }
});

require_once APP_PATH . '/Helpers/functions.php';

use App\Core\Config;
use App\Core\Database;
use App\Core\ModuleManager;
use App\Core\Router;
use App\Services\BusinessProfileManager;
use App\Services\ModuleAccessService;
use App\Services\ThemeManager;

$config = new Config(CONFIG_PATH);
$router = new Router();
$database = new Database($config->get('database'));
$profiles = new BusinessProfileManager($config);
$moduleAccess = new ModuleAccessService($profiles);
$themes = new ThemeManager($config, $database, $profiles);
$modules = new ModuleManager($router, $database, $config, $profiles, $moduleAccess);
$modules->registerDefaultModules();

$GLOBALS['coffee_cms_container'] = [$router, $config, $database, $profiles, $moduleAccess, $themes];

return $GLOBALS['coffee_cms_container'];
