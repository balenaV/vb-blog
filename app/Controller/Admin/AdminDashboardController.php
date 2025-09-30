<?php

namespace app\Controller\Admin;

use app\Core\Helpers;
use app\Core\Session;
use app\Model\UsuarioModel;

class AdminDashboardController extends AdminController
{

    public function dashboard(): void
    {
        echo $this->template->renderizar(
            'dashboard',
            []
        );
    }

    public function sair(): void
    {
        $sessao = new Session();
        $sessao->clear('usuarioId');

        $this->mensagem->alerta("Sua conta foi desconectada. Faça login novamente")->flash();

        Helpers::redirecionar('/admin/login');
    }
}
