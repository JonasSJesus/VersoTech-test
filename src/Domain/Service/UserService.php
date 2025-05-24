<?php

namespace Jonas\Domain\Service;

use Jonas\Core\Database\Connection;
use Jonas\Domain\Dao\ColorDao;
use Jonas\Domain\Dao\UserColorDao;
use Jonas\Domain\Dao\UserDao;
use Jonas\Domain\Model\User;
use PDO;
use PDOException;

class UserService
{
    private PDO $conn;
    private ColorDao $colorDao;
    private UserDao $userDao;
    private UserColorDao $userColorDao;

    public function __construct(Connection $conn, UserDao $userDao, ColorDao $colorDao, UserColorDao $userColorDao)
    {
        $this->conn = $conn->getConnection();
        $this->colorDao = $colorDao;
        $this->userDao = $userDao;
        $this->userColorDao = $userColorDao;
    }

    public function createUserWithColor(string $name, string $email, array $colors)
    {
        $user = new User($name, $email);

        $this->conn->beginTransaction();
        try {
            $userId = $this->userDao->add($user);

            foreach ($colors as $color) {
                $this->userColorDao->addColorUserLink(
                    $userId,
                    $this->colorDao->getById($color)->getId()
                );
            }

            $this->conn->commit();
        } catch (PDOException $e){

            $this->conn->rollBack();
            echo $e->getMessage();
        }
    }

    public function updateUser(string $name, string $email, array|null $colors, int $id)
    {
        $user = new User($name, $email);
        $user->setId($id);

        $this->conn->beginTransaction();

        try {
            $this->userDao->update($user);

            if (isset($colors)) {
                $this->userColorDao->deleteLinks($user->getId());

                foreach ($colors as $colorId) {
                    $this->userColorDao->addColorUserLink($user->getId(), $this->colorDao->getById($colorId)->getId());
                }
            }

            $this->conn->commit();
        } catch (PDOException $e) {
            $this->conn->rollBack();

            echo $e->getMessage();
        }
    }

    public function deleteUserAndLinks(int $userId): bool|string
    {
        $this->conn->beginTransaction();

        try {
            $this->userColorDao->deleteLinks($userId);

            $this->userDao->delete($userId);

            return $this->conn->commit();
        } catch (PDOException $e) {
            $this->conn->rollBack();

            return $e->getMessage();
        }

    }

}