<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= \App\Core\Security::escape($profile['name'] ?? 'Barber Premium'); ?></title>
    <link rel="stylesheet" href="<?= asset_url('css/app.css'); ?>">
    <link rel="stylesheet" href="<?= theme_asset_url('theme.css'); ?>">
</head>
<body class="theme-shell barber-premium">
<header class="theme-header">
    <div class="container theme-nav">
        <a class="theme-brand theme-branding" href="<?= base_url(); ?>">
            <?php if (!empty($branding['logo_url'])): ?>
                <img class="theme-logo" src="<?= \App\Core\Security::escape((string) $branding['logo_url']); ?>" alt="<?= \App\Core\Security::escape((string) ($branding['logo_alt'] ?: $branding['business_name'])); ?>">
            <?php endif; ?>
            <span class="theme-brand-copy">
                <span><?= \App\Core\Security::escape((string) ($branding['business_name'] ?? 'Barber Premium')); ?></span>
                <?php if (!empty($branding['tagline'])): ?>
                    <span class="theme-brand-subtitle"><?= \App\Core\Security::escape((string) $branding['tagline']); ?></span>
                <?php endif; ?>
            </span>
        </a>
        <nav class="theme-links">
            <a href="<?= base_url(); ?>">Home</a>
            <a href="<?= base_url('services'); ?>">Services</a>
            <a href="<?= base_url('reviews'); ?>">Reviews</a>
        </nav>
    </div>
</header>
<main class="container theme-main">
    <?= $content; ?>
</main>
</body>
</html>
