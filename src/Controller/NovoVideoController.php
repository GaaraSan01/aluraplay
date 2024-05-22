<?php

namespace Alura\Mvc\Controller;
use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class NovoVideoController
{
    public function __construct(private VideoRepository $videoRepository)
    {
        
    }

    public function processaRequisicao(): void
    {
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

        if($this->videoRepository->add(new Video($url, $title)) === false){
            header('Location:/?sucesso=0');
        }else {
            header('Location:/?sucesso=1');
        }
    }
}