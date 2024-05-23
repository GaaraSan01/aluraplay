<?php

namespace Alura\Mvc\Controller;

class PageNotFoundController implements Controller
{
    public function processaRequisicao(): void
    {
        http_response_code(404);
    }
}