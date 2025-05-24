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

    public function getAllLinks()
    {
        $sql = "SELECT u.name,
                       u.email,
                       c.name
                FROM users AS u
                LEFT JOIN user_colors AS uc ON u.id = uc.user_id
                LEFT JOIN colors AS c ON uc.color_id = c.id;
                ";
        
        $stmt = $this->conn->query($sql);
        $data = $stmt->fetchAll();
        
        return array_map();
    }

    public function createObj()
    {
        
    }
}