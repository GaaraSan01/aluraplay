<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VideoListController extends ControllerWithHtml
{


    public function __construct(
        private VideoRepository $videoRepository, 
        private Engine $templates
    )
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $videoList = $this->videoRepository->all();
        return new Response(200, body:$this->templates->render(
            'video-list', 
            ['videoList' => $videoList]
        ));
    }
}
