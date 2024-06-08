<?php

namespace Alura\Mvc\Helper;

trait FlashMessageTrait
{
    private function addMessage(string $message): void
    {
        $_SESSION['message'] = $message;
    }
}