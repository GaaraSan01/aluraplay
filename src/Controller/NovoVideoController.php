<?php

namespace Alura\Mvc\Controller;
use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;
use finfo;

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
        if($_FILES['image']['error'] === UPLOAD_ERR_OK){
            //processa o upload
            //armazena o caminho no meu objeto video
            $safeFileName = uniqid('upload_') . pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mineType = $finfo->file($_FILES['image']['tmp_name']);

            if(str_starts_with($mineType, 'image/')){

                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    __DIR__ . '/../../public/img/uploads/' . $safeFileName
                );
                $video->setFilePath($safeFileName);
            }
        }

        if($this->videoRepository->add($video) === false){
            header('Location:/?sucesso=0');
        }else {
            header('Location:/?sucesso=1');
        }
    }
}