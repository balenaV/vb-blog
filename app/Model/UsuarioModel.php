<?php

namespace app\Model;

use app\Core\Model;
use app\Core\Helpers;
use app\Core\Session;

class UsuarioModel extends Model
{

    public function __construct()
    {
        parent::__construct('usuarios');
    }

    public function save(): bool
    {

        if ($this->getAll("email = :e AND id != :id", "e={$this->email}&id={$this->id}")->result()) {
            $this->mensagem->erro('O E-mail inserido já foi registrado!')->flash();
            return false;
        }

        parent::save();
        return true;
    }

    public function getByEmail(string $email): ?UsuarioModel
    {
        $busca = $this->getAll("email = :e", "e={$email}");
        return $busca->result();
    }
}
