<?php

if($_SERVER['PATH_INFO'] === '/' || !array_key_exists('PATH_INFO', $_SERVER)) {
    require_once __DIR__ . '/../listagem-videos.php';
} elseif($_SERVER['PATH_INFO'] === '/novo-video') {
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once __DIR__ . '/../formulario.php';
    } elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__ . '/../novo-video.php';
    }
} elseif($_SERVER['PATH_INFO'] === '/editar-video') {
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once __DIR__ . '/../formulario.php';
    } elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__ . '/../editar-video.php';
    }
} elseif($_SERVER['PATH_INFO'] === '/remover-video') {
    require_once __DIR__ . '/../remover-video.php';
} else {
    http_response_code(404); //dava pra redirecionar pra uma 404 aqui
}