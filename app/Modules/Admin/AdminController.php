<?php

declare(strict_types=1);

namespace App\Modules\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Security;
use PDO;

final class AdminController extends Controller
{
    public function loginForm(): void
    {
        $this->view('Admin/Views/login', [
            'csrf' => Security::csrfToken($this->csrfKey()),
            'csrfKey' => $this->csrfKey(),
        ], 'blank');
    }

    public function login(): void
    {
        Security::verifyCsrf($this->csrfKey());
        $pdo = $this->database->connection();
        $username = Security::sanitizeText($_POST['username'] ?? '');
        $password = (string) ($_POST['password'] ?? '');
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

        if ($this->isBlocked($pdo, $ip)) {
            $_SESSION['flash_error'] = 'Too many login attempts. Please try again later.';
            $this->redirect($this->adminPath() . '/login');
        }

        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        $success = is_array($user) && password_verify($password, $user['password_hash']);
        $this->logLoginAttempt($pdo, $ip, $username, $success);

        if (!$success) {
            $_SESSION['flash_error'] = 'Invalid username or password.';
            $this->redirect($this->adminPath() . '/login');
        }

        Auth::login($user);
        $_SESSION['flash_success'] = 'Welcome back.';
        $this->redirect($this->adminPath());
    }

    public function logout(): void
    {
        Security::verifyCsrf($this->csrfKey());
        Auth::logout();
        $_SESSION['flash_success'] = 'You have been signed out.';
        $this->redirect($this->adminPath() . '/login');
    }

    public function dashboard(): void
    {
        Auth::requireAuth($this->adminPath() . '/login');
        $pdo = $this->database->connection();

        $stats = [
            'pages' => (int) $pdo->query('SELECT COUNT(*) FROM pages')->fetchColumn(),
            'menu_items' => (int) $pdo->query('SELECT COUNT(*) FROM menu_items')->fetchColumn(),
            'promotions' => (int) $pdo->query('SELECT COUNT(*) FROM promotions')->fetchColumn(),
            'theme' => (string) $pdo->query('SELECT folder FROM themes WHERE is_active = 1 LIMIT 1')->fetchColumn(),
            'attempts' => $pdo->query('SELECT username, ip, success, created_at FROM login_attempts ORDER BY created_at DESC LIMIT 5')->fetchAll(),
        ];

        $this->view('Admin/Views/dashboard', [
            'stats' => $stats,
            'csrf' => Security::csrfToken($this->csrfKey()),
            'csrfKey' => $this->csrfKey(),
        ]);
    }

    public function honeypot(): void
    {
        $pdo = $this->database->connection();
        $stmt = $pdo->prepare(
            'INSERT INTO security_logs (type, ip, url, user_agent, message, created_at) VALUES (:type, :ip, :url, :user_agent, :message, NOW())'
        );
        $stmt->execute([
            'type' => 'honeypot',
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'url' => '/admin',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'message' => 'Fake /admin endpoint requested.',
        ]);

        http_response_code(404);
        require APP_PATH . '/Modules/Admin/Views/404.php';
    }

    private function adminPath(): string
    {
        return (string) $this->config->get('config.app.admin_path', 'secret-admin');
    }

    private function csrfKey(): string
    {
        return (string) $this->config->get('security.csrf_key', '_token');
    }

    private function isBlocked(PDO $pdo, string $ip): bool
    {
        $limit = (int) $this->config->get('security.login_attempt_limit', 5);
        $minutes = (int) $this->config->get('security.login_block_minutes', 15);

        $stmt = $pdo->prepare(sprintf(
            'SELECT COUNT(*) FROM login_attempts WHERE ip = :ip AND success = 0 AND created_at >= DATE_SUB(NOW(), INTERVAL %d MINUTE)',
            $minutes
        ));
        $stmt->bindValue(':ip', $ip);
        $stmt->execute();

        return (int) $stmt->fetchColumn() >= $limit;
    }

    private function logLoginAttempt(PDO $pdo, string $ip, string $username, bool $success): void
    {
        $stmt = $pdo->prepare(
            'INSERT INTO login_attempts (ip, username, success, user_agent, created_at) VALUES (:ip, :username, :success, :user_agent, NOW())'
        );
        $stmt->execute([
            'ip' => $ip,
            'username' => $username,
            'success' => $success ? 1 : 0,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        ]);
    }
}
