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

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$response = $controller->processaRequisicao($request);
foreach ($response->getHeaders() as $name => $values) {
        foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);        
    }     
}
echo $response->getBody();