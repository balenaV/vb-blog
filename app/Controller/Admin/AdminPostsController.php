<?php

namespace app\Controller\Admin;

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

    public function indexCategoria(): void
    {
        $categorias = (new CategoriaModel())->getAllWithInactive();

        echo $this->template->renderizar(
            'categorias/indexCategoria',
            [
                'categorias' => $categorias
            ]
        );
    }
}
