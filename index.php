<?php 

// var_dump($_SERVER);
// exit();

if(empty($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO'] === '/'){
    require_once 'listagem-video.php';
} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
    if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once 'formulario.php';
    } elseif ($_SERVER["REQUEST_METHOD"] === 'POST'){
        require_once 'novo-video.php';
    }
}elseif($_SERVER['PATH_INFO'] === '/novo-video'){
    if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once 'formulario.php';
    }elseif($_SERVER["REQUEST_METHOD"] === 'POST'){
        require_once 'novo-video.php';
    }
}elseif($_SERVER['PATH_INFO'] === '/editar-video'){
    if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once 'formulario.php';
    }elseif($_SERVER["REQUEST_METHOD"] === 'POST'){
        require_once 'editar-video.php';
    }
}elseif($_SERVER['PATH_INFO'] === '/remover-video'){
    if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once 'remover-video.php';
    }
}