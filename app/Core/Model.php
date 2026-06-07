<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

abstract class Model
{
    protected PDO $pdo;

    public function __construct(Database $database)
    {
        $this->pdo = $database->connection();
    }
}
