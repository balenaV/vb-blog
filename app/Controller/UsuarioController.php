<?php

namespace app\Controller;

use app\Core\Controller;
use app\Core\Helpers;
use app\Core\Session;
use app\Model\UsuarioModel;

class UsuarioController extends Controller
{
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../layouts/site/views');
    }


    public static function usuario(): ?UsuarioModel
    {
        $sessao = new Session();

        if (!$sessao->check('usuarioId'))
            return null;

        return (new UsuarioModel())->getById($sessao->usuarioId);
    }
}
