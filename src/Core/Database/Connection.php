<?php

namespace Jonas\Core\Database;

use PDO;
use stdClass;

class Connection {

    private string $databaseFile;
    private PDO $connection;

    public function __construct()
    {
        $this->databaseFile = realpath(__DIR__ . "/../../../database/db.sqlite");
        $this->connect();
    }

    private function connect()
    {
        $pdo = new PDO("sqlite:{$this->databaseFile}");
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $this->connection = $pdo;
    }

    public function getConnection()
    {
        return $this->connection ?: $this->connection = $this->connect();
    }

}