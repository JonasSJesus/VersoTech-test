<?php

use Jonas\Core\Database\Connection;
use Jonas\Domain\Controller\UserController;
use Jonas\Domain\Dao\ColorDao;
use Jonas\Domain\Dao\UserColorDao;
use Jonas\Domain\Dao\UserDao;
use Jonas\Domain\Service\UserService;

$connection = new Connection();
$userDao = new UserDao($connection);
$colorDao = new ColorDao($connection);
$userColorDao = new UserColorDao($connection);
$userService = new UserService($connection, $userDao, $colorDao, $userColorDao);

return [
    "GET|/" => [new UserController($userService), 'index'],
    "GET|/insert-user" => [new UserController($userService), 'forms'],
    "GET|/update-user" => [new UserController($userService), 'editForm'],
    "GET|/delete-user" => [new UserController($userService), 'destroy'],

    "POST|/insert-user" => [new UserController($userService), 'store'],
    "POST|/update-user" => [new UserController($userService), 'update'],
];
