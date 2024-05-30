<?php

namespace Alura\Mvc\Controller;
use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class NovoVideoController implements Controller
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
            return;
        }
        
        if($title === false){
            header('Location:/?sucesso=0');
            return;
        }

        $video = new Video($url, $title);
        // if(){
        //     //processa o upload
        //     //armazena o caminho no meu objeto video
        //     $video->setFilePath('');
        // }

        if($this->videoRepository->add($video) === false){
            header('Location:/?sucesso=0');
        }else {
            header('Location:/?sucesso=1');
        }
    }
}