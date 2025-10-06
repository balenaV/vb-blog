<?php

namespace app\Controller\Admin;

use app\Core\Conexao;
use app\Core\Helpers;
use app\Core\Mensagem;
use app\Model\CategoriaModel;
use app\Controller\UsuarioController;

class AdminCategoriasController extends AdminController
{

    /**
     * Seleciona todas categorias do banco
     * @return void
     */
    public function index(): void
    {
        $categoria = new CategoriaModel();

        echo $this->template->renderizar(
            'categorias/index',
            [
                'categorias' => $categoria->getAll()->ordem("id ASC")->result(true),
                'total' => [
                    'todos' => $categoria->count(),
                    'ativo' => $categoria->getAll('status = 1')->count(),
                    'inativo' => $categoria->getAll('status = 0')->count()
                ],
                'usuarioSessao' => $this->usuarioSessao
            ]
        );
    }
    /**
     * Cria categoria
     * @return void
     */
    public function create(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados) && validarDados($dados)) {
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
    /**
     * Edita a categoria selecionada
     * @param int $id id da categoria
     * @return void
     */
    public function edit(int $id): void
    {
        $categoria = (new CategoriaModel())->getById($id);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados) && validarDados($dados)) {

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

    /**
     * Delete a categoria selecionada
     * @param int $id id da categoria 
     * @return void
     */
    public function delete(int $id): void
    {
        if (is_int($id)) {
            $categoria = (new CategoriaModel())->getById($id);
            if ($categoria) {

                try {
                    if ((new CategoriaModel())->delete("id = {$id}")) {
                        $this->mensagem->erro('Categoria excluída com sucesso!')->flash();
                        Helpers::redirecionar('/admin/categorias/index');
                    } else {
                        $this->mensagem->erro($categoria->erro())->flash();
                        Helpers::redirecionar('/admin/categorias/index');
                    }
                } catch (\PDOException $e) {
                    echo "Erro ao deletar categoria: " .  $e->getMessage();
                }
            } else {
                $this->mensagem->alerta('A categoria que você está tentando deletar não existe')->flash();
                Helpers::redirecionar('/admin/categorias/index');
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
            $this->mensagem->alerta('Escreva um título para a Categoria')->flash();
            return false;
        }

        if (empty($dados['texto'])) {
            $this->mensagem->alerta('Escreva um texto para a Categoria')->flash();
            return false;
        }

        return true;
    }
}
