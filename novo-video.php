<?php

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'title');

if($url === false){
    header('Location:/?suceso=0');
    exit();
}

if($title === false){
    header('Location:/?sucesso=0');
    exit();
}

$repository = new VideoRepository($pdo);



if($repository->add(new Video($url, $title)) === false){
    header('Location:/?sucesso=0');
}else {
    header('Location:/?sucesso=1');
}