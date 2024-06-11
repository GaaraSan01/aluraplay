<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FormVideoController extends ControllerWithHtml
{
    public function __construct(
        private VideoRepository $videoRepository,
        private Engine $template
    )
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
        $video = null;

        if ($id !== false && $id !== null) {
            $video = $this-> videoRepository->find($id);
        }

        return new Response(200, body: $this->template->render('form-html', [
            'video'=> $video
        ]));
    }
}
