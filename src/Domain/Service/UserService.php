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

    public function createUserWithColor(User $user, array $colors)
    {
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

    public function linkColorToUser()
    {
        // TODO: Implementar
    }

    public function unlinkColorFromUser()
    {
        // TODO: Implementar
    }

}