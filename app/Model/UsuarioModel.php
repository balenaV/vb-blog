<?php

namespace app\Model;

use app\Core\Model;
use app\Core\Session;

class UsuarioModel extends Model
{

    public function __construct()
    {
        parent::__construct('usuarios');
    }


    public function getByEmail(string $email): ?UsuarioModel
    {
        $busca = $this->getAll("email = :e", "e={$email}");
        return $busca->result();
    }
}
