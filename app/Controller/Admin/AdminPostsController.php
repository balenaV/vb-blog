<?php

namespace app\Controller\Admin;

use app\Core\Helpers;
use app\Model\CategoriaModel;
use app\Model\PostModel;

class AdminPostsController extends AdminController
{

    public function index(): void
    {
        $posts = (new PostModel())->getAllWithInactive();

        echo $this->template->renderizar(
            'posts/index',
            [
                'posts' => $posts,
            ]
        );
    }

    public function create(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {
            (new PostModel())->create($dados);
            Helpers::redirecionar('/admin/posts/index');
        }

        echo $this->template->renderizar(
            'posts/formulario',
            ['categorias' => (new CategoriaModel())->getAll()]
        );
    }
}
