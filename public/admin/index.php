<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/bootstrap/app.php';

$controller = new \App\Modules\Admin\AdminController();
$controller->honeypot();
