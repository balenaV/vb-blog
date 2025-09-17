<?php

namespace app\Controller\Admin;

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
        }

        echo $this->template->renderizar(
            'posts/formulario',
            []
        );
    }
}
