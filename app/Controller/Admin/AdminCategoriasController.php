<?php

namespace app\Controller\Admin;

use app\Core\Conexao;
use app\Core\Helpers;
use app\Core\Mensagem;
use app\Model\CategoriaModel;

class AdminCategoriasController extends AdminController
{
    public function index(): void
    {

        $categoria = new CategoriaModel();
        echo $this->template->renderizar(
            'categorias/index',
            [
                'categorias' => $categoria->getAll()->ordem("id ASC")->result(true),
                'total' => [
                    'todos' => $categoria->count(),
                    'ativo' => $categoria->count('status = 1'),
                    'inativo' => $categoria->count('status = 0')
                ]
            ]
        );
    }

    public function create(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {
            (new CategoriaModel())->create($dados);
            $this->mensagem->sucesso('Categoria criada com sucesso!')->flash();
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
            $this->mensagem->alerta('Categoria editada com sucesso!')->flash();
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
            $this->mensagem->erro('Categoria excluída com sucesso!')->flash();
            Helpers::redirecionar('/admin/categorias/index');
        }
    }
}
