<?php

namespace app\Controller\Admin;

use app\Core\Controller;
use app\Core\Helpers;

class AdminController extends Controller
{
    protected $usuario;

    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../layouts/admin/views');


        $usuario = false;

        if (!$usuario) {
            $this->mensagem->erro('Faça login para acessar o painel de controle!')->flash();

            Helpers::redirecionar('admin/login');
        }
    }
}
