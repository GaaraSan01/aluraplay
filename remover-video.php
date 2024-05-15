<?php 

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$sql = 'DELETE FROM videos WHERE id = ?;';
$statement = $pdo->prepare($sql);
$statement-> bindValue(1, $id);

$statement->execute();

if($statement->execute() === false){
    header('Location:/index.php?suceso=0');
}else {
    header('Location:/index.php?sucesso=1');
}