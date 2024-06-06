<?php

use Alura\Mvc\Controller\{
    EditVideoController,
    FormVideoController,
    JsonVideosListController,
    LoginController,
    LoginFormController,
    LogoutController,
    NewJsonVideoController,
    NovoVideoController,
    RemoveVideoController,
    VideoListController
};


return [
    'GET|/' => VideoListController::class,
    'GET|/novo-video' => FormVideoController::class,
    'POST|/novo-video' => NovoVideoController::class,
    'GET|/editar-video' => FormVideoController::class,
    'POST|/editar-video' => EditVideoController::class,
    'GET|/remover-video' => RemoveVideoController::class,
    'GET|/login' => LoginFormController::class,
    'POST|/login' => LoginController::class,
    'GET|/logout' => LogoutController::class,
    'GET|/videos-json' => JsonVideosListController::class,
    'POST|/videos'=> NewJsonVideoController::class,
];