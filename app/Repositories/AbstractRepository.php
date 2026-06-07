<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database;
use PDO;

abstract class AbstractRepository
{
    protected PDO $pdo;

    public function __construct(Database $database)
    {
        $this->pdo = $database->connection();
    }
}
