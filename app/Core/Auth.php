<?php

declare(strict_types=1);

namespace App\Core;

final class Auth
{
    public static function check(): bool
    {
        return !empty($_SESSION['auth_user']);
    }

    public static function user(): ?array
    {
        return $_SESSION['auth_user'] ?? null;
    }

    public static function login(array $user): void
    {
        $_SESSION['auth_user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
        ];
    }

    public static function logout(): void
    {
        unset($_SESSION['auth_user']);
    }

    public static function requireAuth(string $loginPath): void
    {
        if (self::check()) {
            return;
        }

        header('Location: ' . base_url($loginPath));
        exit;
    }
}
