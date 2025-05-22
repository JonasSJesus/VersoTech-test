<?php

use Jonas\Core\Database\Connection;
use Jonas\Domain\Controller\UserController;
use Jonas\Domain\Dao\UserDao;

$connection = new Connection();
$userDao = new UserDao($connection);

return [
    "GET|/" => [new UserController($userDao), 'index'],
    "GET|/insert-user" => [new UserController($userDao), 'forms'],
    "GET|/update-user" => [new UserController($userDao), 'editForm'],
    "GET|/delete-user" => [new UserController($userDao), 'destroy'],

    "POST|/insert-user" => [new UserController($userDao), 'store'],
    "POST|/update-user" => [new UserController($userDao), 'update'],
];
