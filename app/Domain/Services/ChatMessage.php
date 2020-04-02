<?php

namespace App\Domain\Services;

class ChatMessage
{
    public $message;

    public $sentBy;

    public function __construct(string $message, $sentBy = 1)
    {
        $this->message = $message;
        $this->sentBy = $sentBy;
    }
}
