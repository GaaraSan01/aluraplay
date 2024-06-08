<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VideoListController extends ControllerWithHtml
{


    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $videoList = $this->videoRepository->all();
        return new Response(302, body:$this->renderTemplate(
            'video-list', 
            ['videoList' => $videoList]
        ));
    }
}
