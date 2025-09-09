<?php

namespace infinit\Controlador;

use infinit\Modelo\CategoriaModelo;
use infinit\Nucleo\Controlador;
use infinit\Modelo\PostModelo;
use infinit\Nucleo\Helpers;

class SiteControlador extends Controlador
{
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../layouts/site/views');
    }

    public function index(): void
    {
        $posts = (new PostModelo())->getAll();
        $categorias = (new CategoriaModelo())->getAll();

        echo $this->template->renderizar('index', [
            'posts' => $posts,
            'categorias' => $categorias
        ]);
    }


    public function post(int $id): void
    {
        $post = (new PostModelo())->getById($id);

        if (!$post)
            Helpers::redirecionar('404');

        echo $this->template->renderizar('post', [
            'post' => $post,
            'categorias' => (new CategoriaModelo())->getAll()

        ]);
    }

    public function categoria(int $id): void
    {
        $categoria = (new CategoriaModelo())->getById($id);

        if (!$categoria)
            Helpers::redirecionar('404');

        echo $this->template->renderizar('categoria', [
            'posts' => (new CategoriaModelo())->getPostByCategoriaId($id),
            'categoria' => $categoria,
            'categorias' => (new CategoriaModelo())->getAll(),
        ]);
    }
    public function sobre(): void
    {
        echo $this->template->renderizar('sobre', [
            'titulo' => 'Sobre Nós',
        ]);
    }

    public function buscar(): void
    {
        $busca = filter_input(INPUT_POST, 'busca', FILTER_DEFAULT);

        if (isset($busca)) {
            $posts = (new PostModelo())->pesquisa($busca);

            if (!empty($posts)) {
                foreach ($posts as $post) {
                    echo "<div class='p-2 border-bottom'>
                        <a href= 'post/{$post->id}'>{$post->titulo}</a>
                      </div>";
                }
            } else {
                echo "<div class='alert alert-warning m-2' role='alert'>
                    Não há nenhum post registrado sobre
                    <strong>" . Helpers::resumirTexto(htmlspecialchars($busca), 15) . "</strong>
                  </div>";
            }
        }
    }

    public function busca(): void
    {
        $busca = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($busca)) {
            $posts = (new PostModelo())->pesquisa($busca['busca']);

            echo $this->template->renderizar('busca', [
                'posts' => $posts,
                'categorias' => (new CategoriaModelo())->getAll(),
                'pesquisa' => $busca['busca']
            ]);
        }
    }

    public function erro404(): void
    {
        echo $this->template->renderizar('404', [
            'titulo' => 'Página não encontrada',
        ]);
    }
}
