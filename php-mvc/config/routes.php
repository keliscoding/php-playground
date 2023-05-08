<?php

return [
    'GET|/' => \Zam0k\PhpMvc\Controller\Video\VideoListController::class,
    'GET|/novo-video' => \Zam0k\PhpMvc\Controller\Video\VideoFormController::class,
    'POST|/novo-video' => \Zam0k\PhpMvc\Controller\Video\NewVideoController::class,
    'GET|/editar-video' => \Zam0k\PhpMvc\Controller\Video\VideoFormController::class,
    'POST|/editar-video' => \Zam0k\PhpMvc\Controller\Video\EditVideoController::class,
    'GET|/remover-video' => \Zam0k\PhpMvc\Controller\Video\DeleteVideoController::class,
    'GET|/login' => \Zam0k\PhpMvc\Controller\Auth\LoginFormController::class,
    'POST|/login' => \Zam0k\PhpMvc\Controller\Auth\LoginController::class,
];