<?php

use Zam0k\PhpMvc\Config\Connection;
use Zam0k\PhpMvc\Controller\Video\Error404Controller;
use Zam0k\PhpMvc\Controller\VideoController;
use Zam0k\PhpMvc\Repository\UserRepository;
use Zam0k\PhpMvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

// refatorar isso aqui

$pdo = Connection::create();
$videoRepository = new VideoRepository($pdo);
$userRepository = new UserRepository($pdo);

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

session_start();
session_regenerate_id();
$isLoginRoute = $pathInfo === '/login';
if(!isset($_SESSION['logado']) && !$isLoginRoute) {
    header('Location: /login');
}

$key = "$httpMethod|$pathInfo";

if(array_key_exists($key, $routes)) {
    $controllerClass = $routes[$key];

    if($controllerClass == \Zam0k\PhpMvc\Controller\Auth\LoginController::class) {
        $controller = new $controllerClass($userRepository);
    } else {
        $controller = new $controllerClass($videoRepository);
    }

} else {
    $controller = new Error404Controller();
}

$controller->processaRequisicao();