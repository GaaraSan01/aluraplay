<?php

session_start();
session_regenerate_id();
// var_dump($_SERVER);
// exit();

use Alura\Mvc\Controller\PageNotFoundController;
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

$routes = require_once __DIR__ . '/../config/router.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$isLoginRouter = $pathInfo === '/login';

if (!array_key_exists('logado', $_SESSION) && !$isLoginRouter) {
    header('Location: /login');
    return;
}

$key = "$httpMethod|$pathInfo";

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];

    /** @var Controller $controller */
    $controller = new $controllerClass($videoRepository);
} else {
    $controller = new PageNotFoundController();
}

$controller->processaRequisicao();
