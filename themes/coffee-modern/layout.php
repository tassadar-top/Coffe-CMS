<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= \App\Core\Security::escape($profile['name'] ?? 'Coffee Modern'); ?></title>
    <link rel="stylesheet" href="<?= asset_url('css/app.css'); ?>">
    <link rel="stylesheet" href="<?= theme_asset_url('theme.css'); ?>">
</head>
<body class="theme-shell coffee-modern">
<header class="theme-header">
    <div class="container theme-nav">
        <a class="theme-brand theme-branding" href="<?= base_url(); ?>">
            <?php if (!empty($branding['logo_url'])): ?>
                <img class="theme-logo" src="<?= \App\Core\Security::escape((string) $branding['logo_url']); ?>" alt="<?= \App\Core\Security::escape((string) ($branding['logo_alt'] ?: $branding['business_name'])); ?>">
            <?php endif; ?>
            <span class="theme-brand-copy">
                <span><?= \App\Core\Security::escape((string) ($branding['business_name'] ?? $profile['name'] ?? 'Coffee Modern')); ?></span>
                <?php if (!empty($branding['tagline'])): ?>
                    <span class="theme-brand-subtitle"><?= \App\Core\Security::escape((string) $branding['tagline']); ?></span>
                <?php endif; ?>
            </span>
        </a>
        <nav class="theme-links">
            <a href="<?= base_url(); ?>">Home</a>
            <?php foreach (($adminSections ?? []) as $key => $section): ?>
                <?php if (in_array($key, ['menu', 'promotions', 'gallery', 'reviews', 'contacts', 'blog'], true)): ?>
                    <a href="<?= base_url(ltrim($section['path'], '/')); ?>"><?= \App\Core\Security::escape($section['title']); ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </nav>
    </div>
</header>
<main class="container theme-main">
    <?= $content; ?>
</main>
</body>
</html>
