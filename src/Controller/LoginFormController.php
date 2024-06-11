<?php

namespace Alura\Mvc\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginFormController extends ControllerWithHtml
{
    public function __construct(private Engine $templates)
    {
        
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if(array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true){
            return new Response(302, [
                'Location'=> '/'
            ]);
        }
        echo $this->templates->render('login-form');
    }
}