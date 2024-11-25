<?php

namespace App\Repository;

use App\Core\Database;

abstract class AbstractRepository
{
    /**
     * @var \PDO|null
     */
    protected ?\PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }
}
