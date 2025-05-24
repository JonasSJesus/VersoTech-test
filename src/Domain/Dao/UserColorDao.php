<?php

namespace Jonas\Domain\Dao;

use Jonas\Core\Database\Connection;
use PDO;

class UserColorDao
{
    private PDO $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn->getConnection();
    }

    public function addColorUserLink(int $userId, int $colorId): bool
    {
        $sql = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":user_id", $userId);
        $stmt->bindValue(":color_id", $colorId);

        return $stmt->execute();
    }

    public function deleteLinks(int $userId)
    {
        $sql = "DELETE FROM user_colors WHERE user_id = :user_id;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":user_id", $userId);

        return $stmt->execute();
    }
}
