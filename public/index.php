<?php

// var_dump($_SERVER);
// exit();

use Alura\Mvc\Controller\EditVideoController;
use Alura\Mvc\Controller\FormVideoController;
use Alura\Mvc\Controller\NovoVideoController;
use Alura\Mvc\Controller\PageNotFoundController;
use Alura\Mvc\Controller\RemoveVideoController;
use Alura\Mvc\Controller\VideoListController;
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

$routes = require_once __DIR__ . '/../config/router.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key = "$httpMethod|$pathInfo";

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];

    /** @var Controller $controller */
    $controller = new $controllerClass($videoRepository);
} else {
    $controller = new PageNotFoundController();
}

$controller->processaRequisicao();
