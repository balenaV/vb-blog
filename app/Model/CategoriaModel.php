<?php

namespace app\Model;

use app\Core\Conexao;
use app\Core\Model;

/**
 * Classe CategoriaModel
 */

class CategoriaModel extends Model
{


    public function __construct()
    {
        parent::__construct('categorias');
    }
}
