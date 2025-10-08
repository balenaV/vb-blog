<?php
namespace app\Model;

use app\Core\Model;

class PostModel extends Model
{

    public function __construct()
    {
        parent::__construct('posts');
    }
    public function categoria(): ?CategoriaModel
    {
        if ($this->categoriaId) {
            return (new CategoriaModel())->getById($this->categoriaId);
        }
        return null;
    }
}
