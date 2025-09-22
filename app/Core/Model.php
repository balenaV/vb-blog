<?php


namespace app\Core;


class Model
{

    protected $dados;
    protected $query;
    protected $erro;
    protected $parametros;
    protected $tabela;
    protected $ordem;
    protected $limite;
    protected $offset;

    public function __construct(string $tabela)
    {
        $this->tabela = $tabela;
    }

    public function ordem(string $ordem)
    {
        $this->ordem = " ORDER BY {$ordem}";
        return $this;
    }

    public function getAll(?string $termos = null, ?string $parametros = null, string $colunas = '*')
    {
        $this->query = ($termos) ? "SELECT {$colunas} FROM {$this->tabela} WHERE $termos" : "SELECT {$colunas} FROM {$this->tabela}";
        parse_str($parametros, $this->parametros);
        return $this;
    }

    public function result(bool $todos = false)
    {
        try {
            $stmt = Conexao::getInstancia()->prepare($this->query . $this->ordem);
            $stmt->execute($this->parametros);

            return ($todos) ? $stmt->fetchAll() : $stmt->fetchObject();
        } catch (\PDOException $ex) {
            $this->erro = $ex;
        }
    }
}
