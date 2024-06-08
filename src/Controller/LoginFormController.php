<?php

namespace Alura\Mvc\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginFormController extends ControllerWithHtml
{
    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        if(array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true){
            return new Response(302, [
                'Location'=> '/'
            ]);
        }
        echo $this->renderTemplate('login-form');
    }
}