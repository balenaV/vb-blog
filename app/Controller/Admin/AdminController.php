<?php

namespace app\Controller\Admin;

use app\Core\Controller;
use app\Controller\UsuarioController;
use app\Core\Helpers;
use app\Core\Session;
use app\Model\UsuarioModel;

class AdminController extends Controller
{
    protected $usuarioSessao;

    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../layouts/admin/views');

        $this->usuarioSessao = UsuarioController::usuario();

        if (!$this->usuarioSessao) {
            $this->mensagem->erro('Faça login para acessar o painel de controle!')->flash();

            $sessao = new Session();
            $sessao->clear('usuarioId');

            Helpers::redirecionar('admin/login');
        }
    }
}
