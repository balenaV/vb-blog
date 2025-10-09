<?php

namespace app\Controller\Admin;

use app\Core\Helpers;
use app\Model\CategoriaModel;
use app\Model\PostModel;
use app\Controller\UsuarioController;

class AdminPostsController extends AdminController
{

    /**
     * Seleciona todos posts para listagem
     * @return void
     */
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
                ],
                'usuarioSessao' => $this->usuarioSessao
            ]

        );
    }

    /**
     * Cria um post
     * @return void
     */
    public function create(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {

            if ($this->validarDados($dados)) {
                $post = new PostModel();

                $post->titulo = $dados['titulo'];
                $post->texto = $dados['texto'];
                $post->status = $dados['status'];
                $post->slug = Helpers::criarSlug($dados['titulo']);
                $post->categoriaId = $dados['categoriaId'];
                $post->usuarioId = $this->usuarioSessao->id;

                if ($post->save())
                    $this->mensagem->sucesso('Post criado com sucesso!')->flash();
                else
                    $this->mensagem->erro('Erro ao cadastrar post')->flash();
                Helpers::redirecionar('/admin/posts/index');
            }
        }

        echo $this->template->renderizar(
            'posts/formulario',
            [
                'usuarioSessao' => $this->usuarioSessao,
                'categorias' => (new CategoriaModel())->getAll()->ordem("id ASC")->result(true),
                'post' => $dados
            ]
        );
    }

    /**
     * Edita o post selecionado
     * @param int $id id do post a ser editado
     * @return void
     */
    public function edit(int $id): void
    {
        $post = (new PostModel())->getById($id);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados) && $this->validarDados($dados)) {
            $post = (new PostModel())->getById($id);

            $post->titulo = $dados['titulo'];
            $post->texto = $dados['texto'];
            $post->status = $dados['status'];
            $post->categoriaId = $dados['categoriaId'];
            $post->slug = Helpers::criarSlug($dados['titulo']);

            if ($post->save())
                $this->mensagem->sucesso('Post editado com sucesso!')->flash();
            else
                $this->mensagem->erro('Erro ao editar post')->flash();
            Helpers::redirecionar('/admin/posts/index');
        }

        echo $this->template->renderizar(
            'posts/edit',
            [
                'post' => $post,
                'usuarioSessao' => $this->usuarioSessao,
                'categorias' => (new CategoriaModel())->getAll()->ordem("id ASC")->result(true)
            ]
        );
    }

    /**
     * Deleta o post selecionado
     * @param int $id id do post a ser deletado
     * @return bool
     */
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

    /**
     * Checa os dados do formulário
     * @param array $dados dados a serem validados
     * @return bool
     */
    public function validarDados(array $dados): bool
    {
        if (empty($dados['titulo'])) {
            $this->mensagem->alerta('Escreva um título para o Post')->flash();
            return false;
        }

        if (empty($dados['texto'])) {
            $this->mensagem->alerta('Escreva um texto para o Post')->flash();
            return false;
        }

        return true;
    }
}
