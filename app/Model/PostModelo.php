<?php

namespace infinit\Modelo;

use infinit\Nucleo\Conexao;
use PDOException;

class PostModelo
{
    public function getAll(): array
    {
        $query = "SELECT * FROM  posts WHERE status = 1 ORDER BY id DESC";
        $stmt = Conexao::getInstancia()->query($query);

        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function getById(int $id): bool|object
    {
        $query = "SELECT * FROM posts WHERE id = $id;";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetch();

        return $resultado;
    }

    public function pesquisa(string $busca): array
    {
        $query = "SELECT * FROM posts WHERE status = 1 AND titulo LIKE '%$busca%'";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function createPost($titulo, $texto, $status)
    {
        try {
            $query = "INSERT INTO `posts` (`id`, `titulo`, `texto`, `status`) VALUES (NULL, '$titulo', '$texto', '$status');";
            $stmt = Conexao::getInstancia()->query($query);
        } catch (PDOException $ex) {
            echo "NÃO FOI POSSIVEL CRIAR O <strong>POST</strong> <br>" . $ex->getMessage();
        }
    }
}
