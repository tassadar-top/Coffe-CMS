<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link rel="stylesheet" href="<?= asset_url('css/app.css'); ?>">
</head>
<body>
<main class="container" style="max-width: 540px; padding: 48px 0;">
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
