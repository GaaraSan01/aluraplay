<?php 

// var_dump($_SERVER);

if($_SERVER['REQUEST_URI'] === '/'){
    require_once 'listagem-video.php';
} elseif ($_SERVER['REQUEST_URI'] === '/novo-video') {
    if ($_SERVER["REQUEST_METHOD"] === 'GET'){
        require_once 'formulario.php';
    } elseif ($_SERVER["REQUEST_METHOD"] === 'POST'){
        require_once 'novo-video.php';
    }
}