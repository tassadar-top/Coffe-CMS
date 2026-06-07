<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= \App\Core\Security::escape($profile['name'] ?? 'Coffee Dark'); ?></title>
    <link rel="stylesheet" href="<?= asset_url('css/app.css'); ?>">
    <link rel="stylesheet" href="<?= theme_asset_url('theme.css'); ?>">
</head>
<body class="theme-shell coffee-dark">
<header class="theme-header">
    <div class="container theme-nav">
        <a class="theme-brand" href="<?= base_url(); ?>">Coffee Dark</a>
        <nav class="theme-links">
            <a href="<?= base_url(); ?>">Home</a>
            <a href="<?= base_url('menu'); ?>">Catalog</a>
            <a href="<?= base_url('reviews'); ?>">Reviews</a>
        </nav>
    </div>
</header>
<main class="container theme-main">
    <?= $content; ?>
</main>
</body>
</html>
