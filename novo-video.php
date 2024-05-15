<?php 

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'title');

if($url === false){
    header('Location:/index.php?suceso=0');
    exit();
}

if($title === false){
    header('Location: /index.php?sucesso=0');
    exit();
}

$sql = 'INSERT INTO videos (url, title) VALUES (?, ?);';
$statement = $pdo->prepare($sql);


$statement->execute();

if($statement->execute() === false){
    
}else {
    header('Location:/index.php?sucesso=1');
}