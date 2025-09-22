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

    /**
     * Cria uma sessão e recebe seus dados
     * @param string $chave nome da sessão
     * @param mixed $valor dados da sessão
     * @return Session
     */
    public function create(string $chave, mixed $valor): Session
    {
        $_SESSION[$chave] = (is_array($valor) ? (object) $valor : $valor);

        return $this;
    }

    /**
     * Carrega dados de uma sessão
     * @return ?object
     */
    public function load(): ?object
    {
        return (object) $_SESSION;
    }

    /**
     * Checa se a sessão existe
     * @param string $chave nome da sessão
     * @return bool 
     */
    public function check(string $chave): bool
    {
        return isset($_SESSION[$chave]);
    }

    /**
     * Limpa os dados de uma sessão
     * @param string $chave nome da sessão
     * @return Session
     */
    public function clear(string $chave): Session
    {
        unset($_SESSION[$chave]);
        return $this;
    }


    /**
     * Delete todos os dados registrados de uma sessão
     * @return Session
     */
    public function delete(): Session
    {
        session_destroy();
        return $this;
    }

    public function __get($atributo)
    {
        if (!empty($_SESSION[$atributo])) {
            return $_SESSION[$atributo];
        }
    }


    public function flash(): ?Mensagem
    {
        if ($this->check('flash')) {
            $flash = $this->flash;
            $this->clear('flash');
            return $flash;
        }
        return null;
    }
}
