<?php


use DI\ContainerBuilder;
use League\Plates\Engine;

use function DI\create;

$builder = new ContainerBuilder();
$dbPath = __DIR__ . '/../banco.sqlite';
$builder->addDefinitions([
    // PDO::class => function(): PDO {
    //     $dbPath = __DIR__ . '/../banco.sqlite';
    //     return new PDO("sqlite:$dbPath");
    // }

    PDO::class => create(PDO::class)->constructor("sqlite:$dbPath"),

    Engine::class => function(){
        $templatePath = __DIR__ . '/../views';
        return new Engine($templatePath);
    }
]);

/** @var \Psr\Container\ContainerInterface $container */
$container = $builder->build();

return $container;