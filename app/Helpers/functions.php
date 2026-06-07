<?php

declare(strict_types=1);

function base_url(string $path = ''): string
{
    $clean = '/' . ltrim($path, '/');

    return $clean === '/' ? '/' : $clean;
}

function asset_url(string $path): string
{
    return base_url('assets/' . ltrim($path, '/'));
}

function public_upload_url(?string $path): ?string
{
    if (!$path) {
        return null;
    }

    return base_url(ltrim($path, '/'));
}

function theme_asset_url(string $path): string
{
    $container = $GLOBALS['coffee_cms_container'] ?? [];
    $themeManager = $container[5] ?? null;

    if ($themeManager instanceof \App\Services\ThemeManager) {
        return $themeManager->assetUrl($path);
    }

    return base_url(ltrim($path, '/'));
}
