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

class EditVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;
    public function __construct(private VideoRepository $videoRepository)
    {
        
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $queryBody = $request->getParsedBody();
        $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);

        if($id === false && $id !== null){
            $this->addMessage('Id Inválido!');
            return new Response(302, [
                'Location' => '/'
            ]);
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

        $files = $request->getUploadedFiles();
        $uploadedImage = $files['image'];

        if($uploadedImage->getError() === UPLOAD_ERR_OK){
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $tmpFile = $uploadedImage->getStream()->getMetadata('uri');
            $mimeType = $finfo->file($tmpFile);
            if (str_starts_with($mimeType, 'image/')) {
                $safeFileName = uniqid('upload_') . '_' . pathinfo($uploadedImage->getClientFilename(), PATHINFO_BASENAME);
                $uploadedImage->moveTo(__DIR__ . '/../../public/img/uploads/' . $safeFileName);
                $video->setFilePath($safeFileName);
            }
        }
        $success = $this->videoRepository->update($video);
        
        if ($success === false) {
            $this->addMessage('Erro ao atualizar o vídeo');
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        return new Response(302, [
            'Location' => '/'
        ]);
    }
}