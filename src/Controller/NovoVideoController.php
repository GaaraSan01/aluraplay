<?php

namespace Alura\Mvc\Controller;
use Alura\Mvc\Entity\Video;
use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use finfo;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NovoVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;
    public function __construct(private VideoRepository $videoRepository)
    {
        
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryBory = $request->getParsedBody();
        $url = filter_var($queryBory['url'], FILTER_VALIDATE_URL);
        $title = filter_var($queryBory['title']);

        if($url === false){
            $this->addMessage('URL inválida!');
            return new Response(302, [
                'Location'=> '/novo-video'
            ]);
        }
        
        if($title === false){
            $this->addMessage('Titulo inválido!');
            return new Response(302, [
                'Location'=> '/novo-video'
            ]);
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
            $this->addMessage('Erro ao adicionar o video!');
            return new Response(302, [
                'Location'=> '/novo-video'
            ]);
        }else {
            return new Response(302, [
                'Location'=> '/'
            ]);
        }
    }
}