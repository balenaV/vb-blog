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
                'posts' => $posts->getAll()->ordem("id ASC")->result(true),
                'total' => [
                    'todos' => $posts->count(),
                    'ativo' => $posts->count('status = 1'),
                    'inativo' => $posts->count('status = 0')
                ]
            ]
        );
    }

    public function create(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {
            (new PostModel())->create($dados);
            $this->mensagem->sucesso('Post cadastrado com sucesso!')->flash();
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
            $this->mensagem->alerta('Post editado com sucesso!')->flash();
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
            $this->mensagem->erro('Post excluído com sucesso!')->flash();
            Helpers::redirecionar('/admin/posts/index');
        }
    }
}
