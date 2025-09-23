<?php


namespace app\Core;

use stdClass;

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
    protected $mensagem;

    public function __construct(string $tabela)
    {
        $this->tabela = $tabela;

        $this->mensagem = new Mensagem();
    }

    public function __set($nome, $valor)
    {
        if (empty($this->dados)) {
            $this->dados = new \stdClass();
        }

        $this->dados->$nome = $valor;
    }

    public function __isset($nome)
    {
        return isset($this->dados->$nome);
    }

    public function __get($nome)
    {
        return $this->dados->$nome ?? null;
    }

    public function dados()
    {
        $this->dados = new \stdClass();
    }
    public function erro()
    {
        return $this->erro;
    }

    public function mensagem()
    {
        return $this->mensagem;
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

            if (!$stmt->rowCount())
                return null;


            return ($todos) ? $stmt->fetchAll() : $stmt->fetchObject(static::class);
        } catch (\PDOException $ex) {
            echo $this->erro = $ex;
        }
    }

    protected function create(array $dados)
    {
        try {
            $colunas = implode(',', array_keys($dados));
            $valores = ':' . implode(',:', array_keys($dados));

            $query = "INSERT INTO {$this->tabela} ({$colunas}) VALUES ({$valores})";
            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute($this->filtro($dados));

            return Conexao::getInstancia()->lastInsertId();
        } catch (\PDOException $ex) {
            echo $this->erro = $ex;
            return null;
        }
    }


    protected function update(array $dados, string $termos)
    {
        try {
            $set = [];

            foreach ($dados as $chave => $valor) {
                $set[] = "{$chave} = :{$chave}";
            }
            $set = implode(', ', $set);
            $query = "UPDATE {$this->tabela} SET {$set} WHERE {$termos}";

            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute($this->filtro($dados));

            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $ex) {
            echo $this->erro = $ex;
            return null;
        }
    }


    public function delete(string $termos)
    {
        try {
            $query = "DELETE FROM {$this->tabela} WHERE {$termos}";

            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute();

            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $ex) {
            echo $this->erro = $ex;
            return null;
        }
    }

    private function filtro(array $dados)
    {
        $filtro = [];

        foreach ($dados as $chave => $valor) {
            $filtro[$chave] = filter_var($valor, FILTER_DEFAULT) ?? null;
        }

        return $filtro;
    }

    protected function store()
    {
        $dados = (array) $this->dados;

        return $dados;
    }


    public function getById(int $id)
    {
        $get = $this->getAll("id = {$id}");
        return $get->result();
    }
    public function save()
    {
        if (empty($this->id)) {
            $id = $this->create($this->store());
            if ($this->erro) {
                $this->mensagem()->erro('Erro no sistema ao tentar cadastrar os dados');
                return false;
            }
        }
        if (!empty($this->id)) {
            $id = $this->id;
            $this->update($this->store(), " id = $id");
            if ($this->erro) {
                $this->mensagem()->erro('Erro no sistema ao tentar cadastrar os dados');
                return false;
            }
        }


        $this->dados = $this->getById($id)->dados();
        return true;
    }
}
