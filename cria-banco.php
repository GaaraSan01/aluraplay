<?php

$sql = 'CREATE TABLE videos (id INTEGER PRIMARY KEY, url TEXT, title TEXT);';
$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$pdo->exec($sql);