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
                    'ativo' => $categoria->getAll('status = 1'),
                    'inativo' => $categoria->getAll('status = 0')
                ]
            ]
        );
    }

    public function create(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {
            $categoria = new CategoriaModel();

            $categoria->titulo = $dados['titulo'];
            $categoria->texto = $dados['titulo'];
            $categoria->status = $dados['titulo'];
            if ($categoria->save()) {

                $this->mensagem->sucesso('Categoria criada com sucesso!')->flash();
                Helpers::redirecionar('/admin/categorias/index');
            }
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

            $categoria = (new CategoriaModel())->getById($id);

            $categoria->titulo = $dados['titulo'];
            $categoria->texto = $dados['texto'];
            $categoria->status = $dados['status'];
            if ($categoria->save()) {
                $this->mensagem->alerta('Categoria editada com sucesso!')->flash();
                Helpers::redirecionar('/admin/categorias/index');
            }
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
        if (is_int($id)) {
            $categoria = (new CategoriaModel())->getById($id);
            if ($categoria) {
                if ((new CategoriaModel())->delete("id = {$id}")) {
                    $this->mensagem->erro('Categoria excluída com sucesso!')->flash();
                    Helpers::redirecionar('/admin/categorias/index');
                } else {
                    $this->mensagem->erro($categoria->erro())->flash();
                    Helpers::redirecionar('/admin/categorias/index');
                }
            } else {
                $this->mensagem->alerta('A categoria que você está tentando deletar não existe')->flash();
                Helpers::redirecionar('/admin/categorias/index');
            }
        }
    }
}
