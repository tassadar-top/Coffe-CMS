<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= \App\Core\Security::escape($profile['name'] ?? 'Barber Classic'); ?></title>
    <link rel="stylesheet" href="<?= asset_url('css/app.css'); ?>">
    <link rel="stylesheet" href="<?= theme_asset_url('theme.css'); ?>">
</head>
<body class="theme-shell barber-classic">
<header class="theme-header">
    <div class="container theme-nav">
        <a class="theme-brand" href="<?= base_url(); ?>">Barber Classic</a>
        <nav class="theme-links">
            <a href="<?= base_url(); ?>">Home</a>
            <a href="<?= base_url('services'); ?>">Services</a>
            <a href="<?= base_url('masters'); ?>">Masters</a>
            <a href="<?= base_url('portfolio'); ?>">Portfolio</a>
        </nav>
    </div>
</header>
<main class="container theme-main">
    <?= $content; ?>
</main>
</body>
</html>
