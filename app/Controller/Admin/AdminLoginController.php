<?php

namespace app\Controller\Admin;

use app\Core\Controller;
use app\Core\Helpers;
use app\Core\Session;
use app\Model\UsuarioModel;

class AdminLoginController extends Controller
{
    protected $usuario;

    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../layouts/admin/views');
    }

    public function login()
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados['email']) && isset($dados['senha'])) {
            $usuario = (new UsuarioModel())->getByEmail($dados['email']);

            if (!$this->validarUsuario($usuario, $dados)) {
                Helpers::redirecionar('/admin/login');
                return;
            }

            $usuario->ultimoLogin = date("Y-m-d h:i:s");
            $usuario->save();

            (new Session())->create('usuarioId', $usuario->id);
            $this->mensagem->sucesso("{$usuario->nome}, seja bem vindo!")->flash();
            Helpers::redirecionar('/admin/dashboard');
            return;
        }
        echo $this->template->renderizar('login', []);
    }


    public function validarUsuario(?UsuarioModel $usuario = null, mixed $dados): bool
    {
        if (!$usuario) {
            $this->mensagem->alerta("E-mail e/ou senha incorreto(os)")->flash();
            return false;
        }
        if (!Helpers::validarEmail($dados['email'])) {
            $this->mensagem->alerta("Insira um e-mail válido!")->flash();
            return false;
        }

        if ($dados['senha'] != $usuario->senha) {
            $this->mensagem->alerta("Usuário e/ou senha incorreto(os)")->flash();
            return false;
        }

        if ($usuario->status != 1) {
            $this->mensagem->alerta("Sua conta está desativada")->flash();
            return false;
        }

        if ($usuario->level < 3) {
            $this->mensagem->alerta("Usuário sem permissão para acessar o painel")->flash();
            return false;
        }

        return true;
    }
}
