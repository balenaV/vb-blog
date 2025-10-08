<?php
namespace app\Controller\Admin;

use app\Core\Controller;
use app\Core\Helpers;
use app\Core\Session;
use app\Model\UsuarioModel;

class AdminLoginController extends Controller
{
    protected $usuario;

    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../layouts/admin/views');
    }

    /**
     * Inicia uma nova sessão de um usuário
     * @return void
     */
    public function login(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados['email']) && isset($dados['senha'])) {
            $usuario = (new UsuarioModel())->getByEmail($dados['email']);

            if (! $this->validarUsuario($usuario, $dados)) {
                Helpers::redirecionar('/admin/login');
                return;
            }

            $usuario->ultimoLogin = date("Y-m-d h:i:s");
            $usuario->save();

            (new Session())->create('usuarioId', $usuario->id);
            $this->mensagem->sucesso("" . trim($usuario->nome) . ", seja bem vindo!")->flash();
            if ($usuario->level < 3) {
                Helpers::redirecionar('/../../../blog');
            }

            Helpers::redirecionar('/admin/dashboard');
            return;
        }
        echo $this->template->renderizar('login', []);
    }

    /**
     * Registra novo usuário
     * @return void
     */
    public function register(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados) && (new AdminUsuariosController())->validarDados($dados)) {
            $usuario = new UsuarioModel();

            $usuario->nome   = $dados['nome'] . ' ' . $dados['sobrenome'];
            $usuario->email  = $dados['email'];
            $usuario->senha  = Helpers::gerarSenha($dados['senha']);
            $usuario->level  = $dados['level'] ?? 1;
            $usuario->status = $dados['status'] ?? 1;

            if ($usuario->save()) {
                $this->mensagem->sucesso('Usuário cadastrado com sucesso')->flash();
                Helpers::redirecionar('/admin/login');
            }
        }
    }

    /**
     * Valida dados do usuário
     * @param ?UsuarioModel $usuario usuário a ser validado
     * @param mixed $dados dados a serem validados
     * @return bool
     */
    public function validarUsuario(?UsuarioModel $usuario = null, mixed $dados): bool
    {
        if (! $usuario) {
            $this->mensagem->alerta("E-mail e/ou senha incorreto(os)")->flash();
            return false;
        }
        if (! Helpers::validarEmail($dados['email'])) {
            $this->mensagem->alerta("Insira um e-mail válido!")->flash();
            return false;
        }

        if (Helpers::validarSenha($dados['senha']) != $usuario->senha) {
            $this->mensagem->alerta("Usuário e/ou senha incorreto(os)")->flash();
            return false;
        }

        if ($usuario->status != 1) {
            $this->mensagem->alerta("Sua conta está desativada")->flash();
            return false;
        }

        return true;
    }
}
