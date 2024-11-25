<?php

use App\Core\Autoloader;
use App\Core\Database;
use App\Core\Router;

include_once '../src/Core/Autoloader.php';

Autoloader::register();
Database::initConnexion();

$router = new Router();
$router->execute();
