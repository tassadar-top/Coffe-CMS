<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

final class Database
{
    private ?PDO $pdo = null;
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function connection(): PDO
    {
        if ($this->pdo instanceof PDO) {
            return $this->pdo;
        }

        $dsn = $this->buildDsn();

        try {
            $this->pdo = new PDO($dsn, $this->config['username'], $this->config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $exception) {
            throw new PDOException(
                'Database connection failed. Check config/database.php and import database/install.sql.',
                (int) $exception->getCode(),
                $exception
            );
        }

        return $this->pdo;
    }

    private function buildDsn(): string
    {
        $driver = (string) $this->config['driver'];
        $database = (string) $this->config['database'];
        $charset = (string) $this->config['charset'];
        $socket = trim((string) ($this->config['socket'] ?? ''));

        if ($socket !== '') {
            return sprintf(
                '%s:unix_socket=%s;dbname=%s;charset=%s',
                $driver,
                $socket,
                $database,
                $charset
            );
        }

        return sprintf(
            '%s:host=%s;port=%d;dbname=%s;charset=%s',
            $driver,
            (string) $this->config['host'],
            (int) $this->config['port'],
            $database,
            $charset
        );
    }
}
