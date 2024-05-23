<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class FormVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $video = null;

        if ($id !== false && $id !== null) {
            $video = $this-> videoRepository->find($id);
        }

        require_once __DIR__ . '/../../views/form-html.php';
    }
}
