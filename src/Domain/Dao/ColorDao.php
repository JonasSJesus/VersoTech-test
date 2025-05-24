<?php

namespace Jonas\Domain\Dao;

use Jonas\Core\Database\Connection;
use Jonas\Domain\Model\Color;
use PDO;

class ColorDao
{
    private PDO $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn->getConnection();
    }

    /** @return Color[] */
    public function all(): array
    {
        $sql = "SELECT * FROM colors";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return array_map(function ($dataFromDb) {
            return $this->createObj($dataFromDb);
        }, $data);
    }

    public function add(Color $color): bool
    {
        $sql = "INSERT INTO colors (name) VALUES (:name);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $color->colorName);

        return $stmt->execute();
    }

    public function getById(int $id): Color
    {
        $sql = "SELECT * FROM colors WHERE id = :id;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch();

        return $this->createObj($data);
    }


    public function createObj(array $data): Color
    {
        $color = new Color($data['name']);
        $color->setId($data['id']);

        return $color;
    }
}