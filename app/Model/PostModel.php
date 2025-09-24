<?php

namespace app\Model;

use app\Core\Conexao;
use app\Core\Model;
use PDOException;

class PostModel extends Model
{

    public function __construct()
    {
        parent::__construct('posts');
    }
}
