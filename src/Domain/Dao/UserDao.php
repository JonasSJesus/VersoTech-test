<?php

namespace Jonas\Domain\Dao;

use Jonas\Core\Database\Connection;
use Jonas\Domain\Model\User;
use PDO;

class UserDao
{
    private PDO $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn->getConnection();
    }


    /** 
     * @return User[] 
     */
    public function all(): array
    {
        $stmt = $this->conn->query("SELECT * FROM users;");
        $data = $stmt->fetchAll();

        return array_map(function ($dataFromDB) {
            return $this->createObj($dataFromDB);
        }, $data);
    }

    public function add(User $user): int
    {
        $sql = "INSERT INTO users (name, email) VALUES (:name, :email);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $user->name);
        $stmt->bindValue(':email', $user->email);

        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function getById(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = :id;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch();

        return $this->createObj($data);
    }

    public function update(int $id, string $name, string $email)
    {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM users WHERE id = :id;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }


    private function createObj(array $data)
    {
        return new User($data['id'], $data['name'], $data['email']);
    }

}