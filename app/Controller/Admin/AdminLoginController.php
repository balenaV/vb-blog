<?php

namespace app\Controller\Admin;

use app\Core\Controller;
use app\Core\Helpers;

class AdminLoginController extends Controller
{
    protected $usuario;

    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../layouts/admin/views');
    }

    public function login(): void
    {
        echo $this->template->renderizar('login', []);
    }
}
