<?php
namespace app\Model;

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

    public function posts(): ?array
    {
        return (new PostModel())->getAll("categoriaId = {$this->id}")->result(true);
    }
}
