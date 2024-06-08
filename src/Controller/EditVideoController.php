<?php 

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EditVideoController implements Controller
{
    use FlashMessageTrait;
    public function __construct(private VideoRepository $videoRepository)
    {
        
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $queryBody = $request->getParsedBody();
        $id = filter_var($queryBody['id'], FILTER_VALIDATE_INT);

        if($id === false && $id !== null){
            header('Location: /?sucesso=0');
            exit();
        }
        
        $url = filter_var($queryBody['url'], FILTER_VALIDATE_URL);
        $title = filter_var($queryBody['title']);
        
        if($url === false){
            $this->addMessage('URL inválida!');
            return new Response(302, [
                'Location' => '/editar-video'
            ]);
        }
        
        if($title === false){
            $this->addMessage('Titulo inválido!');
            return new Response(302, [
                'Location' => '/editar-video'
            ]);
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
            $this->addMessage('Erro ao editar o video!');
            return new Response(302, [
                'Location' => '/editar-video'
            ]);
        } else {
            return new Response(302, [
                'Location' => '/'
            ]);
        }
    }
}