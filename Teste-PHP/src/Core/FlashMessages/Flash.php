<?php

namespace Jonas\Core\FlashMessages;

trait Flash
{
    public function registerMessage(string $typeOfMessage, string $message): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION['flash'][$typeOfMessage] = $message;
        }
    }
}