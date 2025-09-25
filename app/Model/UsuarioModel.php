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



    public function login(array $dados, int $level = 1)
    {
        $usuario = (new UsuarioModel())->getByEmail($dados['email']);

        if (!$usuario) {
            $this->mensagem->alerta("Usuário e/ou senha incorreto(os)")->flash();
            return false;
        }
        if ($dados['senha'] != $usuario->senha) {
            $this->mensagem->alerta("Senha incorreta")->flash();
            return false;
        }
        if ($usuario->status != 1) {
            $this->mensagem->alerta("Sua conta está desativada")->flash();
            return false;
        }

        if ($usuario->level < $level) {
            $this->mensagem->alerta("Usuário sem permissão")->flash();
            return false;
        }


        (new Session())->create('usuariodId', $usuario->id);

        $this->mensagem->sucesso("{$usuario->nome}, seja bem vindo ao painel de controle")->flash();
        return true;
    }
}
