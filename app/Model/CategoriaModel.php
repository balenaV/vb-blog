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



    /**
     *  Lista todas categorias no banco incluindo as inativas
     * @param ?string $termo filtro da busca
     * @param ?string $ordem ordem da busca
     * @return array
     */
    public function getAllWithInactive(?string $termo = null): array
    {
        $termo = ($termo ? "WHERE  {$termo} " : '');
        $ordem = ($ordem ? " ORDER BY {$ordem}" : '');

        $query = "SELECT * FROM  categorias $termo $ordem";
        $stmt  = Conexao::getInstancia()->query($query);

        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    /**
     *  Lista todos os posts que pertencem à determinada categoria
     * @param int $id ID da categoria
     * @param ?string $ordem ordem da busca
     */
    public function getPostByCategoriaId(int $id, ?string $ordem = null): array
    {
        $ordem = ($ordem ? " ORDER BY {$ordem}" : '');

        $query     = "SELECT * FROM posts WHERE categoriaid = $id AND status = 1 $ordem";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    /**
     * Busca post específico por ID
     * @param int $id ID do produto 
     * @return bool | object
     */
    public function getById(int $id): bool | object
    {
        $query     = "SELECT * FROM categorias WHERE id = $id $ordem;";
        $stmt      = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetch();

        return $resultado;
    }

    // public function create(array $dados): void
    // {
    //     try {
    //         $query = "INSERT INTO categorias (`titulo`, `texto`, `status`) VALUES (:titulo, :texto, :status);";
    //         $stmt  = Conexao::getInstancia()->prepare($query);
    //         $stmt->execute($dados);
    //     } catch (PDOException $ex) {
    //         echo "NÃO FOI POSSIVEL CRIAR A <strong>CATEGORIA</strong> <br>" . $ex->getMessage();
    //     }
    // }

    // public function edit(array $dados, int $id): void
    // {
    //     try {
    //         $query = "UPDATE categorias SET
    //         titulo = :titulo,
    //         texto = :texto,
    //         status = :status
    //         WHERE id = $id;";
    //         $stmt = Conexao::getInstancia()->prepare($query);
    //         $stmt->execute($dados);
    //     } catch (PDOException $ex) {
    //         echo "NÃO FOI POSSIVEL ATUALIZAR A <strong>CATEGORIA</strong> <br>" . $ex->getMessage();
    //     }
    // }

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

    public function count(?string $termo = null): int
    {

        $termo = ($termo ? "WHERE {$termo}" : '');

        $query = "SELECT * FROM categorias $termo";
        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->execute();


        return $stmt->rowCount();
    }
}
