<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FormVideoController extends ControllerWithHtml
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $queryBody = $request->getParsedBody();
        $id = filter_var($queryBody['id'], FILTER_VALIDATE_INT);
        $video = null;

        if ($id !== false && $id !== null) {
            $video = $this-> videoRepository->find($id);
        }

        return new Response(200, body: $this->renderTemplate('form-html', [
            'video'=> $video
        ]));
    }
}
