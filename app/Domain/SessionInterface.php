<?php

namespace App\Domain;

interface SessionInterface
{
    public function get($parameter);

    public function set($parameter, $value): void;
}
