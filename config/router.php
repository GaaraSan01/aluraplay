<?php

use Alura\Mvc\Controller\EditVideoController;
use Alura\Mvc\Controller\FormVideoController;
use Alura\Mvc\Controller\LoginController;
use Alura\Mvc\Controller\LoginFormController;
use Alura\Mvc\Controller\LogoutController;
use Alura\Mvc\Controller\NovoVideoController;
use Alura\Mvc\Controller\RemoveVideoController;
use Alura\Mvc\Controller\VideoListController;

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
];