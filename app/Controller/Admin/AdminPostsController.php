<?php

namespace app\Controller\Admin;

use app\Core\Helpers;
use app\Model\CategoriaModel;
use app\Model\PostModel;

class AdminPostsController extends AdminController
{

    public function index(): void
    {
        $posts = (new PostModel());

        echo $this->template->renderizar(
            'posts/index',
            [
                'posts' => $posts->getAllWithInactive(),
                'total' => $posts->count(),
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

    public function edit(int $id): void
    {
        $post = (new PostModel())->getById($id);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {
            (new PostModel())->edit($dados, $id);
            Helpers::redirecionar('/admin/posts/index');
        }

        echo $this->template->renderizar(
            'posts/edit',
            [
                'post' => $post,
                'categorias' => (new CategoriaModel())->getAll()
            ]
        );
    }

    public function delete(int $id): void
    {
        $post = (new PostModel())->getById($id);

        if ($post) {
            (new PostModel())->delete($id);
            Helpers::redirecionar('/admin/posts/index');
        }
    }
}
