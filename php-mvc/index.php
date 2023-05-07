<?php

if($_SERVER['PATH_INFO'] === '/' || !array_key_exists('PATH_INFO', $_SERVER)) {
    require_once './listagem-videos.php';
} elseif($_SERVER['PATH_INFO'] === '/novo-video') {
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once './formulario.php';
    } elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once './novo-video.php';
    }
} elseif($_SERVER['PATH_INFO'] === '/editar-video') {
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once './formulario.php';
    } elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once './editar-video.php';
    }
} elseif($_SERVER['PATH_INFO'] === '/remover-video') {
    require_once './remover-video.php';
}