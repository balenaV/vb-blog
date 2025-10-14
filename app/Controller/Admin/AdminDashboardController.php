<?php

namespace app\Controller\Admin;

use app\Controller\UsuarioController;
use app\Core\Helpers;
use app\Core\Session;
use app\Model\CategoriaModel;
use app\Model\PostModel;
use app\Model\UsuarioModel;

class AdminDashboardController extends AdminController
{

    /**
     * Carrega todas as informações do dashboard
     * @return void
     */
    public function dashboard(): void
    {
        $posts = new PostModel();
        $categorias = new CategoriaModel();
        $usuarios = new UsuarioModel();

        echo $this->template->renderizar(
            'dashboard',
            [
                'posts' => [
                    'total' => $posts->getAll()->count(),
                    'total' => $posts->getAll()->count(),
                    'ativo' => $posts->getAll('status = 1')->count(),
                    'inativo' => $posts->getAll('status = 0')->count(),
                ],
                'categorias' => [
                    'total' => $categorias->getAll()->count(),
                    'ativo' => $categorias->getAll('status = 1')->count(),
                    'inativo' => $categorias->getAll('status = 0')->count(),

                ],
                'usuarios' => [
                    'total' => $usuarios->getAll()->count(),
                    'ativo' => $usuarios->getAll('status = 1')->count(),
                    'inativo' => $usuarios->getAll('status = 0')->count(),
                ],
                'admins' => [
                    'total' => $usuarios->getAll('level = 3')->count(),
                    'ativo' => $usuarios->getAll('status = 1 and level = 3')->count(),
                    'inativo' => $usuarios->getAll('status = 0 and level = 3')->count(),
                ],
                'ultimasCategorias' => $categorias->getAll()->ordem("id DESC")->limite("5")->result(true),
                'ultimosPosts' => $posts->getAll()->ordem("id DESC")->limite("5")->result(true),
                'ultimosLogins' => $usuarios->getAll()->ordem("ultimoLogin DESC")->limite("5")->result(true),
                'usuarioSessao' => $this->usuarioSessao
            ]
        );
    }

    /**
     * Finaliza sessão do usuário
     * @return void
     */
    public function sair(): void
    {
        $sessao = new Session();
        $sessao->clear('usuarioId');

        $this->mensagem->alerta("Sua conta foi desconectada. Faça login novamente")->flash();

        Helpers::redirecionar('/admin/login');
    }
}
