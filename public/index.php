<?php 

// var_dump($_SERVER);
// exit();

require_once __DIR__ . '/../vendor/autoload.php';

if(empty($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO'] === '/'){
    require_once __DIR__ . '/../listagem-video.php';
} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
    if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once __DIR__ . '/../formulario.php';
    } elseif ($_SERVER["REQUEST_METHOD"] === 'POST'){
        require_once __DIR__ . '/../novo-video.php';
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