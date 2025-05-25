<?php

use Jonas\Core\Router\Route;

ini_set('display_errors', true);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
$routes = require_once __DIR__ . '/../config/routes.php';

$router = new Route($routes);

$router->dispatch();