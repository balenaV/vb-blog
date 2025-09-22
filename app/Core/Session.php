<?php

namespace app\Core;

class Session
{

    public function __construct()
    {
        if (!session_id()) {
            session_start();
        }
    }

    public function create(string $chave, mixed $valor): Session
    {
        return $_SESSION[$chave] = (is_array($valor) ? (object) $valor : $valor);
    }
    public function load(): ?object
    {
        return (object) $_SESSION;
    }
    public function check(string $chave): bool
    {
        return isset($_SESSION[$chave]);
    }
    public function clear(strig $chave): Session
    {
        unset($_SESSION[$chave]);
        return $this;
    }
    public function delete(): Session
    {
        session_destroy();
        return $this;
    }
}
