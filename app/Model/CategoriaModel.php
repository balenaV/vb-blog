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

    public function create(array $dados): void
    {
        try {
            $query = "INSERT INTO categorias (`titulo`, `texto`, `status`) VALUES (:titulo, :texto, :status);";
            $stmt  = Conexao::getInstancia()->prepare($query);
            $stmt->execute($dados);
        } catch (PDOException $ex) {
            echo "NÃO FOI POSSIVEL CRIAR A <strong>CATEGORIA</strong> <br>" . $ex->getMessage();
        }
    }

    public function edit(array $dados, int $id): void
    {
        try {
            $query = "UPDATE categorias SET 
            titulo = :titulo,
            texto = :texto,
            status = :status
            WHERE id = $id;";
            $stmt  = Conexao::getInstancia()->prepare($query);
            $stmt->execute($dados);
        } catch (PDOException $ex) {
            echo "NÃO FOI POSSIVEL ATUALIZAR A <strong>CATEGORIA</strong> <br>" . $ex->getMessage();
        }
    }

    public function delete(int $id): void
    {
        try {
            $query = "DELETE FROM  categorias WHERE id = $id;";
            $stmt  = Conexao::getInstancia()->prepare($query);
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "NÃO FOI POSSIVEL DELETAR A <strong>Categorias</strong> <br>" . $ex->getMessage();
        }
    }

    public function count(): int
    {
        $query = "SELECT * FROM categorias";
        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->execute();


        return $stmt->rowCount();
    }
}
