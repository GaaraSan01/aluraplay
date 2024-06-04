<?php 

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class EditVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
        
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if($id === false && $id !== null){
            header('Location: /?sucesso=0');
            exit();
        }
        
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'title');
        
        if($url === false){
            header('Location:/?suceso=0');
            exit();
        }
        
        if($title === false){
            header('Location: /?sucesso=0');
            exit();
        }
        $video = new Video($url, $title);
        $video->setId($id);

        if($_FILES['image']['error'] === UPLOAD_ERR_OK){
            //processa o upload
            //armazena o caminho no meu objeto video
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                __DIR__ . '/../../public/img/uploads/' . $_FILES['image']['name']
            );
            $video->setFilePath($_FILES['image']['name']);
        }
        
        
        if($this->videoRepository->update($video) === false){
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}