<?php

namespace app\Controller\Admin;

use app\Core\Controller;
use app\Core\Helpers;
use app\Model\UsuarioModel;

class AdminLoginController extends Controller
{
    protected $usuario;

    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../layouts/admin/views');
    }

    public function login()
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados)) {
            $usuario = (new UsuarioModel())->login($dados, 3);

            if ($usuario)
                Helpers::redirecionar('/admin/dashboard');
        }
        echo $this->template->renderizar('login', []);
    }
}
