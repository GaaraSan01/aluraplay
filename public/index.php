<?php 

// var_dump($_SERVER);
// exit();

use Alura\Mvc\Controller\NovoVideoController;
use Alura\Mvc\Controller\VideoListController;
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

if(empty($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO'] === '/'){
    $controller = new VideoListController($videoRepository);
    $controller->processaRequisicao();
} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
    if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once __DIR__ . '/../formulario.php';
    } elseif ($_SERVER["REQUEST_METHOD"] === 'POST'){
        $controller = new NovoVideoController($videoRepository);
        $controller->processaRequisicao();
    }
}elseif($_SERVER['PATH_INFO'] === '/novo-video'){
    if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once __DIR__ . '/../formulario.php';
    }elseif($_SERVER["REQUEST_METHOD"] === 'POST'){
        require_once __DIR__ . '/../novo-video.php';
    }
}elseif($_SERVER['PATH_INFO'] === '/editar-video'){
    if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once __DIR__ . '/../formulario.php';
    }elseif($_SERVER["REQUEST_METHOD"] === 'POST'){
        require_once __DIR__ . '/../editar-video.php';
    }
}elseif($_SERVER['PATH_INFO'] === '/remover-video'){
    if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once __DIR__ . '/../remover-video.php';
    }
} else {
    http_response_code(404);
}