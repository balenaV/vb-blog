<?php
namespace app\Controller\Admin;

use app\Controller\Admin\AdminController;
use app\Core\Helpers;
use app\Model\UsuarioModel;

class AdminUsuariosController extends AdminController
{

    public function create(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados) && $this->validarDados($dados)) {
            $usuario = new UsuarioModel();

            $usuario->nome   = $dados['nome'];
            $usuario->email  = $dados['email'];
            $usuario->senha  = $dados['senha'];
            $usuario->level  = $dados['level'];
            $usuario->status = $dados['status'];

            if ($usuario->save()) {
                $this->mensagem()->sucesso('Usuário cadastrado com sucesso')->flash();
                Helpers::redirecionar('/admin/usuarios/index');
            }
        }

        echo $this->template->renderizar('usuarios/formulario', []);
    }

    public function edit(int $id): void
    {
        $usuario      = (new UsuarioModel())->getById($id);
        $nomeCompleto = explode(' ', $usuario->nome);
        $nome         = $nomeCompleto[0];
        $sobrenome    = $nomeCompleto[1];

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados) && $this->validarDados($dados)) {
            $usuario = (new UsuarioModel())->getById($id);

            $usuario->nome   = $dados['nome'];
            $usuario->email  = $dados['email'];
            $usuario->senha  = (! empty($dados['senha'])) ? $dados['senha'] : $usuario->senha;
            $usuario->level  = $dados['level'];
            $usuario->status = $dados['status'];

            if ($usuario->save()) {
                $this->mensagem->sucesso('Usuário editado com sucesso')->flash();
                Helpers::redirecionar('/admin/usuarios/index');
            }
        }

        echo $this->template->renderizar('usuarios/edit', [
            'usuario'   => $usuario,
            'nome'      => $nome,
            'sobrenome' => $sobrenome,
        ]);
    }

    public function delete(int $id): void
    {
        if (is_int($id)) {
            $usuario = (new UsuarioModel())->getById($id);
            if ($usuario) {
                if ((new UsuarioModel())->delete("id = {$id}")) {
                    $this->mensagem->erro('Usuário excluído com sucesso!')->flash();
                    Helpers::redirecionar('/admin/usuarios/index');
                } else {
                    $this->mensagem->erro($usuario->erro())->flash();
                    Helpers::redirecionar('/admin/usuarios/index');
                }
            } else {
                $this->mensagem->alerta('O usuário que você está tentando deletar não existe')->flash();
                Helpers::redirecionar('/admin/usuarios/index');
            }
        }
    }
    public function index(): void
    {
        $usuarios = (new UsuarioModel());

        echo $this->template->renderizar(
            'usuarios/index',
            [
                'usuarios' => $usuarios->getAll()->ordem("id ASC")->result(true),
                'total'    => [
                    'todos'         => $usuarios->count(),
                    'usuario'       => [
                        'ativo'   => $usuarios->getAll('status = 1 and level = 1')->count(),
                        'inativo' => $usuarios->getAll('status = 0 and level = 1')->count(),
                    ],
                    'criador'       => [
                        'ativo'   => $usuarios->getAll('status = 1 and level = 2')->count(),
                        'inativo' => $usuarios->getAll('status = 0 and level = 2')->count(),
                    ],
                    'administrador' => [
                        'ativo'   => $usuarios->getAll('status = 1 and level = 3')->count(),
                        'inativo' => $usuarios->getAll('status = 0 and level = 3')->count(),
                    ],
                ],
            ]
        );
    }

    public function validarDados(mixed $dados): bool
    {

        if (! Helpers::validarEmail($dados['email'])) {
            $this->mensagem->alerta("Insira um e-mail válido!")->flash();
            return false;
        }

        if (empty($dados['senha'])) {
            $this->mensagem->alerta("Informe uma senha para o usuário")->flash();
            return false;
        }

        return true;
    }
}
