<?php

declare(strict_types=1);

namespace App\Core;

final class Security
{
    public static function csrfToken(string $key = '_token'): string
    {
        if (empty($_SESSION[$key])) {
            $_SESSION[$key] = bin2hex(random_bytes(32));
        }

        return $_SESSION[$key];
    }

    public static function verifyCsrf(string $key = '_token'): void
    {
        $token = $_POST[$key] ?? '';

        if (!hash_equals($_SESSION[$key] ?? '', (string) $token)) {
            http_response_code(419);
            exit('Invalid CSRF token.');
        }
    }

    public static function sanitizeText(?string $value): string
    {
        return trim((string) $value);
    }

    public static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public static function handleImageUpload(
        string $field,
        string $directory,
        array $allowedExtensions,
        array $allowedMimeTypes,
        int $maxSize
    ): ?string {
        if (empty($_FILES[$field]['name'])) {
            return null;
        }

        $file = $_FILES[$field];

        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            throw new \RuntimeException('Image upload failed.');
        }

        if (($file['size'] ?? 0) > $maxSize) {
            throw new \RuntimeException('Image is too large.');
        }

        $extension = strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedExtensions, true)) {
            throw new \RuntimeException('Unsupported image extension.');
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mime, $allowedMimeTypes, true)) {
            throw new \RuntimeException('Unsupported image type.');
        }

        $targetDir = PUBLIC_PATH . '/uploads/' . trim($directory, '/');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        $filename = bin2hex(random_bytes(12)) . '.' . $extension;
        $target = $targetDir . '/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $target)) {
            throw new \RuntimeException('Unable to save uploaded image.');
        }

        return 'uploads/' . trim($directory, '/') . '/' . $filename;
    }

    public static function deleteUpload(?string $relativePath): void
    {
        if (!$relativePath) {
            return;
        }

        $fullPath = PUBLIC_PATH . '/' . ltrim($relativePath, '/');
        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }
}
