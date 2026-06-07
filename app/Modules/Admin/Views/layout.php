<?php use App\Core\Auth; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coffee CMS</title>
    <link rel="stylesheet" href="<?= asset_url('css/app.css'); ?>">
</head>
<body>
<header class="<?= Auth::check() ? 'admin-header' : 'site-header'; ?>">
    <div class="container">
        <nav class="<?= Auth::check() ? 'admin-nav' : 'site-nav'; ?>">
            <a class="<?= Auth::check() ? 'admin-brand' : 'site-brand'; ?>" href="<?= base_url(); ?>">Coffee CMS</a>
            <?php if (Auth::check()): ?>
                <div class="admin-links">
                    <a href="<?= base_url($adminPath ?? ''); ?>">Dashboard</a>
                    <?php foreach (($adminSections ?? []) as $section): ?>
                        <a href="<?= base_url(($adminPath ?? '') . $section['path']); ?>"><?= \App\Core\Security::escape($section['title']); ?></a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="site-links">
                    <a href="<?= base_url(); ?>">Home</a>
                    <?php foreach (($adminSections ?? []) as $key => $section): ?>
                        <?php if (in_array($key, ['menu', 'services', 'portfolio', 'promotions', 'gallery', 'reviews', 'contacts', 'blog', 'account'], true)): ?>
                            <a href="<?= base_url(ltrim($section['path'], '/')); ?>"><?= \App\Core\Security::escape($section['title']); ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">
    <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="flash success"><?= \App\Core\Security::escape((string) $_SESSION['flash_success']); unset($_SESSION['flash_success']); ?></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="flash error"><?= \App\Core\Security::escape((string) $_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
    <?php endif; ?>
    <?= $content; ?>
</main>
</body>
</html>
