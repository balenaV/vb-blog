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


    // public function getAllWithInactive(?string $termo = null): array
    // {
    //     $termo = ($termo ? "WHERE  {$termo} " : '');

    //     $query = "SELECT * FROM  posts $termo ORDER BY id ASC";
    //     $stmt  = Conexao::getInstancia()->query($query);

    //     $resultado = $stmt->fetchAll();

    //     return $resultado;
    // }

    // public function getById(int $id): bool | object
    // {
    //     $query     = "SELECT * FROM posts WHERE id = $id;";
    //     $stmt      = Conexao::getInstancia()->query($query);
    //     $resultado = $stmt->fetch();

    //     return $resultado;
    // }

    public function getByUser(int $id): array
    {
        $query     = "SELECT * FROM posts WHERE usuarioId = $id;";
        $stmt      = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function pesquisa(string $busca): array
    {
        $query     = "SELECT * FROM " . self::TABELA . " WHERE titulo LIKE '%$busca%'";
        $stmt      = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function count(): int
    {
        $stmt = Conexao::getInstancia()->prepare($this->query);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
