<?php

namespace app\Controller\Admin;

use app\Core\Conexao;
use app\Core\Helpers;
use app\Model\CategoriaModel;
use app\Model\PostModel;

class AdminCategoriasController extends AdminController
{
    public function index(): void
    {

        $categoria = new CategoriaModel();
        echo $this->template->renderizar(
            'categorias/index',
            [
                'categorias' => $categoria->getAllWithInactive(),
                'total' => $categoria->count(),
            ]
        );
    }

    public function create(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {
            (new CategoriaModel())->create($dados);
            Helpers::redirecionar('/admin/categorias/index');
        }

        echo $this->template->renderizar(
            'categorias/formulario',
            []
        );
    }

    public function edit(int $id): void
    {
        $categoria = (new CategoriaModel())->getById($id);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {
            (new CategoriaModel())->edit($dados, $id);
            Helpers::redirecionar('/admin/categorias/index');
        }

        echo $this->template->renderizar(
            'categorias/edit',
            [
                'categoria' => $categoria
            ]
        );
    }

    public function delete(int $id): void
    {
        $categoria = (new CategoriaModel())->getById($id);

        if ($categoria) {
            (new CategoriaModel())->delete($id);
            Helpers::redirecionar('/admin/categorias/index');
        }
    }
}
