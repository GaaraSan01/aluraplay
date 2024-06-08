<?php

namespace Alura\Mvc\Controller;

abstract class ControllerWithHtml implements Controller
{
    private const TEMPLATE_PATH =  __DIR__ . '/../../views/';

    protected function renderTemplate(string $templateName, array $context = []): string
    {
        extract($context);
        
        //Inicializa um buffer de saída;
        ob_start();
        require_once self::TEMPLATE_PATH . $templateName . '.php';
        return ob_get_clean();
    }
}