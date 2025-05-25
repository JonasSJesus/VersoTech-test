<?php

namespace Jonas\Domain\Dao;

use Jonas\Core\Database\Connection;
use Jonas\Domain\Model\Color;
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
        $sql = "SELECT u.id as userId,
                       c.id AS colorId,
                       u.name AS username,
                       u.email,
                       c.name AS colorname
                FROM users AS u
                LEFT JOIN user_colors AS uc ON u.id = uc.user_id
                LEFT JOIN colors AS c ON uc.color_id = c.id;
                ";

        $stmt = $this->conn->query($sql);
        $data = $stmt->fetchAll();

        return $this->createObj($data);
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

    public function getById(int $id): array
    {
        $sql = "SELECT u.id AS userId,
                       c.id AS colorId,
                       u.name AS username,
                       u.email,
                       c.name AS colorname
                FROM users AS u
                LEFT JOIN user_colors AS uc ON u.id = uc.user_id
                LEFT JOIN colors AS c ON uc.color_id = c.id
                WHERE u.id = :id;
                ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->createObj($data);
    }

    public function update(User $user): bool
    {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $user->name);
        $stmt->bindValue(':email', $user->email);
        $stmt->bindValue(':id', $user->getId());

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM users WHERE id = :id;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }


    /**
     * Realiza uma filtragem no retorno de usuario, evitando usuarios repetidos
     *
     * @param array $data
     * @return User[] Retorna um array de usuarios com suas cores associadas
     */
    private function createObj(array $data): array
    {
        $userList = [];
        foreach ($data as $row) {
            if (!array_key_exists($row['userId'], $userList)) {
                $user = new User($row['username'], $row['email']);
                $user->setId($row['userId']);

                $userList[$row['userId']] = $user;
            }

            if (!empty($row["colorId"]) && !empty($row["colorname"])) {
                $color = new Color($row['colorname']);
                $color->setId($row['colorId']);

                $userList[$row['userId']]->setColor($color);
            }
        }

        return $userList;
    }

}