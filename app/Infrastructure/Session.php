<?php

namespace App\Infrastructure;

use App\Domain\SessionInterface;

class Session implements SessionInterface
{
    public function __construct() {
        if (empty(session_id())) {
            session_set_cookie_params(0);
            session_start();
        }
    }

    public function get($parameter)
    {
        return array_key_exists($parameter, $_SESSION) ? $_SESSION[$parameter] : null;
    }

    public function set($parameter, $value): void
    {
        $_SESSION[$parameter] = $value;
    }
}
