<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class RemoveVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = $_GET['id'];

        if ($this->videoRepository->remove($id) === false) {
            header('Location:/?suceso=0');
        } else {
            header('Location:/?sucesso=1');
        }
    }
}
