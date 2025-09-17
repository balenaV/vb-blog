<?php

namespace app\Controller\Admin;

use app\Model\CategoriaModel;
use app\Model\PostModel;

class AdminCategoriasController extends AdminController
{
    public function index(): void
    {
        $categorias = (new CategoriaModel())->getAllWithInactive();

        echo $this->template->renderizar(
            'categorias/index',
            [
                'categorias' => $categorias
            ]
        );
    }

    public function create(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {
        }

        echo $this->template->renderizar(
            'categorias/formulario',
            []
        );
    }
}
