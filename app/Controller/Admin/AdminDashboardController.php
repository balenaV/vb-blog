<?php

namespace app\Controller\Admin;

use app\Core\Helpers;
use app\Core\Session;
use app\Model\PostModel;
use app\Model\UsuarioModel;

class AdminDashboardController extends AdminController
{

    public function dashboard(): void
    {
        $posts = new PostModel();
        $usuarios = new UsuarioModel();

        echo $this->template->renderizar(
            'dashboard',
            [
                'posts' => [
                    'total' => $posts->getAll()->count(),
                    'ativo' => $posts->getAll('status = 1')->count(),
                    'inativo' => $posts->getAll('status = 0')->count(),
                ],
                'usuarios' => [
                    'total' => $usuarios->getAll()->count(),
                    'ativo' => $usuarios->getAll('status = 1')->count(),
                    'inativo' => $usuarios->getAll('status = 0')->count(),
                ]
            ]
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
