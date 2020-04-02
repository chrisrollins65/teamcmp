<?php

namespace App\Infrastructure;

use Exception;
use PDO;

class Database
{
    private static $instance;
    private $connection;

    private function __construct() {
        $databasePath = __DIR__.'/../../database/database.sqlite';
        $this->connection = new PDO('sqlite:' . $databasePath);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    final public function __clone()
    {
        throw new Exception('Feature disabled.');
    }

    final public function __wakeup()
    {
        throw new Exception('Feature disabled.');
    }

    public function query($query, $parameters = []) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($parameters);

        return $stmt;
    }
}
