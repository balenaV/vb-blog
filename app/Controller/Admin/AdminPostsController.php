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
                    'ativo' => $posts->getAll('status = 1')->count(),
                    'inativo' => $posts->getAll('status = 0')->count()
                ]
            ]
        );
    }

    public function create(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {
            $post = new PostModel();

            $post->titulo = $dados['titulo'];
            $post->texto = $dados['texto'];
            $post->status = $dados['status'];
            $post->categoriaId = $dados['categoriaId'];

            if ($post->save()) {
                $this->mensagem->sucesso('Post cadastrado com sucesso!')->flash();
                Helpers::redirecionar('/admin/posts/index');
            }
        }

        echo $this->template->renderizar(
            'posts/formulario',
            ['categorias' => (new CategoriaModel())->getAll()->ordem("id ASC")->result(true)]
        );
    }

    public function edit(int $id): void
    {
        $post = (new PostModel())->getById($id);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {
            $post = (new PostModel())->getById($id);

            $post->titulo = $dados['titulo'];
            $post->texto = $dados['texto'];
            $post->status = $dados['status'];
            $post->categoriaId = $dados['categoriaId'];

            if ($post->save()) {
                $this->mensagem->alerta('Post editado com sucesso!')->flash();
                Helpers::redirecionar('/admin/posts/index');
            }
        }

        echo $this->template->renderizar(
            'posts/edit',
            [
                'post' => $post,
                'categorias' => (new CategoriaModel())->getAll()->ordem("id ASC")->result(true)
            ]
        );
    }

    public function delete(int $id): void
    {
        if (is_int($id)) {

            $post = (new PostModel())->getById($id);
            if ($post) {
                (new PostModel())->delete(" id ={$id}");
                $this->mensagem->erro('Post excluído com sucesso!')->flash();
                Helpers::redirecionar('/admin/posts/index');
            } else {
                $this->mensagem->alerta('O post que você está tentando deletar não existe!')->flash();
                Helpers::redirecionar('/admin/posts/index');
            }
        }
    }
}
