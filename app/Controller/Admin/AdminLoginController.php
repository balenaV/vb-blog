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

            if (!$usuario) {
                $this->mensagem->alerta("Usuário e/ou senha incorreto(os)")->flash();
                Helpers::redirecionar('/admin/login');
                return;
            }

            if ($dados['senha'] != $usuario->senha) {
                $this->mensagem->alerta("Usuário e/ou senha incorreto(os)")->flash();
                Helpers::redirecionar('/admin/login');
                return;
            }

            if ($usuario->status != 1) {
                $this->mensagem->alerta("Sua conta está desativada")->flash();
                Helpers::redirecionar('/admin/login');
                return;
            }

            if ($usuario->level < 3) {
                $this->mensagem->alerta("Usuário sem permissão para acessar o painel")->flash();
                Helpers::redirecionar('/admin/login');
                return;
            }

            (new Session())->create('usuarioId', $usuario->id);
            $this->mensagem->sucesso("{$usuario->nome}, seja bem vindo!")->flash();
            Helpers::redirecionar('/admin/dashboard');
            return;
        }
        echo $this->template->renderizar('login', []);
    }
}
