<?php

use Alura\Mvc\Repository\VideoRepository;

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = $_GET['id'];

$repository = new VideoRepository($pdo);

if($repository->remove($id) === false){
    header('Location:/?suceso=0');
}else {
    header('Location:/?sucesso=1');
}