<?php

namespace app\Controller\Admin;

use app\Controller\Admin\AdminController;
use app\Core\Helpers;
use app\Model\UsuarioModel;
use app\Controller\UsuarioController;

class AdminUsuariosController extends AdminController
{



    public function create(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados) && $this->validarDados($dados)) {
            $usuario = new UsuarioModel();

            $usuario->nome   = $dados['nome'] . ' ' .  $dados['sobrenome'];
            $usuario->email  = $dados['email'];
            $usuario->senha  = Helpers::gerarSenha($dados['senha']);
            $usuario->level  = $dados['level'];
            $usuario->status = $dados['status'];


            if ($post->save())
                $this->mensagem->sucesso('Usuário criado com sucesso!')->flash();
            else
                $this->mensagem->erro('Erro ao cadastrar usuário')->flash();
            Helpers::redirecionar('/admin/usuarios/index');
        }

        echo $this->template->renderizar('usuarios/formulario', [
            'usuarioSessao' => $this->usuarioSessao
        ]);
    }

    public function edit(int $id): void
    {
        $usuario      = (new UsuarioModel())->getById($id);
        $nomeCompleto = explode(' ', $usuario->nome);
        $nome         = $nomeCompleto[0];
        $sobrenome    = $nomeCompleto[1];

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            $usuario = (new UsuarioModel())->getById($id);

            if ($this->validarDados($dados)) {
                $usuario->nome   = $dados['nome']  . ' ' .  $dados['sobrenome'];
                $usuario->email  = $dados['email'];
                $usuario->senha  =  !(empty($dados['senha'])) ? Helpers::gerarSenha($dados['senha']) :   $usuario->senha;
                $usuario->level  = $dados['level'];
                $usuario->status = $dados['status'];

                if ($post->save())
                    $this->mensagem->sucesso('Usuário editado com sucesso!')->flash();
                else
                    $this->mensagem->erro('Erro ao editar usuário')->flash();
                Helpers::redirecionar('/admin/usuarios/index');
            }
        }

        echo $this->template->renderizar('usuarios/edit', [
            'usuario'   => $usuario,
            'nome'      => $nome,
            'sobrenome' => $sobrenome,
            'usuarioSessao' => $this->usuarioSessao

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
                'usuarioSessao' => $this->usuarioSessao
            ]
        );
    }

    public function validarDados(mixed $dados): bool
    {
        if (! Helpers::validarEmail($dados['email'])) {
            $this->mensagem->alerta("Insira um e-mail válido!")->flash();
            return false;
        }

        if (!empty($dados['senha'])) {
            if (!Helpers::validarSenha($dados['senha'])) {
                $this->mensagem->alerta("A senha deve ter entre 6 e 50 caracteres!")->flash();
                return false;
            }
        }

        return true;
    }
}
