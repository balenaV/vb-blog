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

    public function usuario(): ?UsuarioModel
    {
        if ($this->usuarioId) {
            return (new UsuarioModel())->getById($this->usuarioId);
        }
        return null;
    }

    public function save(): bool
    {
        $this->slug();

        return parent::save();
    }
}
