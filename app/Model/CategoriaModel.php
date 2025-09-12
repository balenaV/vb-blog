<?php

namespace app\Model;

use app\Core\Conexao;

/**
 * Classe CategoriaModel
 */

class CategoriaModel
{

    public function getAll(): array
    {
        $query     = "SELECT * FROM categorias WHERE status = 1 ";
        $stmt      = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function getAllWithInactive(): array
    {
        $query = "SELECT * FROM  categorias  ORDER BY id ASC";
        $stmt  = Conexao::getInstancia()->query($query);

        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function getPostByCategoriaId(int $id): array
    {
        $query     = "SELECT * FROM posts WHERE categoriaid = $id AND status = 1 ORDER BY id DESC;";
        $stmt      = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function getById(int $id): bool | object
    {
        $query     = "SELECT * FROM categorias WHERE id = $id;";
        $stmt      = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetch();

        return $resultado;
    }

    public function createCategoria($titulo, $texto, $status)
    {
        try {
            $query = "INSERT INTO `categorias` (`id`, `titulo`, `texto`, `status`) VALUES (NULL, '$titulo', '$texto', '$status');";
            $stmt  = Conexao::getInstancia()->query($query);
        } catch (PDOException $ex) {
            echo "NÃO FOI POSSIVEL CRIAR A <strong>CATEGORIA</strong> <br>" . $ex->getMessage();
        }
    }
}
