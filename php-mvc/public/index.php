<?php

use Zam0k\PhpMvc\Config\Connection;
use Zam0k\PhpMvc\Controller\VideoController;
use Zam0k\PhpMvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$pdo = Connection::create();
$videoRepository = new VideoRepository($pdo);
$controller = new VideoController($videoRepository);

if($_SERVER['PATH_INFO'] === '/' || !array_key_exists('PATH_INFO', $_SERVER)) {
    $controller->showListVideoPage();
} elseif($_SERVER['PATH_INFO'] === '/novo-video') {
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->showFormularioPage();
    } elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->createVideo();
    }
} elseif($_SERVER['PATH_INFO'] === '/editar-video') {
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->showFormularioPage();
    } elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->editVideo();
    }
} elseif($_SERVER['PATH_INFO'] === '/remover-video') {
    $controller->removeVideo();
} else {
    http_response_code(404); //dava pra redirecionar pra uma 404 aqui
}