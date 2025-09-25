<?php

namespace app\Model;

use app\Core\Model;

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

    public function login(array $dados, int $level = 1)
    {
        $usuario = (new UsuarioModel())->getByEmail($dados['email']);

        if (!$usuario) {
            $this->mensagem->alerta("Usuário e/ou senha incorreto(os)")->flash();
            return false;
        }

        $this->mensagem->sucesso("{$usuario->nome}, seja bem vindo ao painel de controle")->flash();
        return true;
    }
}
