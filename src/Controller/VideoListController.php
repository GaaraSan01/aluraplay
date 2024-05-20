<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use PDO;

class VideoListController
{
    private VideoRepository $videoRepository;

    public function __construct()
    {   
        $dbPath = __DIR__ . '/banco.sqlite';
        $pdo = new PDO("sqlite:$dbPath");

        $this->videoRepository = new VideoRepository($pdo);
        
    }

    public function processaRequisicao(): void
    {
        $videoList = $this->videoRepository->all();
    }
}