<?php

namespace app\Model;

use app\Core\Conexao;
use PDOException;

class PostModel
{
    public function getAll(): array
    {
        $query = "SELECT * FROM  posts WHERE status = 1 ORDER BY id DESC";
        $stmt  = Conexao::getInstancia()->query($query);

        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function getAllWithInactive(): array
    {
        $query = "SELECT * FROM  posts  ORDER BY id ASC";
        $stmt  = Conexao::getInstancia()->query($query);

        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function getById(int $id): bool | object
    {
        $query     = "SELECT * FROM posts WHERE id = $id;";
        $stmt      = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetch();

        return $resultado;
    }

    public function getByUser(int $id): array
    {
        $query     = "SELECT * FROM posts WHERE usuarioId = $id;";
        $stmt      = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function pesquisa(string $busca): array
    {
        $query     = "SELECT * FROM posts WHERE status = 1 AND titulo LIKE '%$busca%'";
        $stmt      = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function create(array $dados): void
    {
        try {
            $query = "INSERT INTO `posts` (`titulo`, `texto`, `status`,`categoriaId`) VALUES (?,?,?,?);";
            $stmt  = Conexao::getInstancia()->prepare($query);
            $stmt->execute([$dados['titulo'], $dados['texto'], $dados['status'], $dados['categoria']]);
        } catch (PDOException $ex) {
            echo "NÃO FOI POSSIVEL CRIAR O <strong>POST</strong> <br>" . $ex->getMessage();
        }
    }
}
