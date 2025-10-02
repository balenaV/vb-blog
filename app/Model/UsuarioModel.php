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
        // CADASTRAR
        if (empty($this->id)) {

            if ($this->getByEmail($this->email)) {
                $this->mensagem->erro('O E-mail inserido já foi registrado!')->flash();
                Helpers::redirecionar('/admin/login');
                return false;
            }
            $id = $this->create($this->store());
            if ($this->erro) {
                $this->mensagem()->erro('Erro no sistema ao tentar cadastrar os dados');
                return false;
            }
        }

        // ATUALIZAR
        if (!empty($this->id)) {
            $id = $this->id;
            $this->update($this->store(), " id = $id");
            if ($this->erro) {
                $this->mensagem()->erro('Erro no sistema ao tentar cadastrar os dados');
                return false;
            }
        }


        return true;
    }

    public function getByEmail(string $email): ?UsuarioModel
    {
        $busca = $this->getAll("email = :e", "e={$email}");
        return $busca->result();
    }
}
