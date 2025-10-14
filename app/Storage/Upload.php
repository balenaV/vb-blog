<?php

namespace sistema\Biblioteca;

/**
 * Classe Upload
 *
 *
 */
class Upload
{
    private ?string $diretorio;
    private ?array $arquivo;
    private ?string $nome;
    private ?string $subDiretorio;
    private ?int $tamanho;
    private ?string $result;
    private ?string $erro;

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function getErro(): ?string
    {
        return $this->erro;
    }


    public function __construct(?string $diretorio = null)
    {
        $this->diretorio = $diretorio ?? 'uploads';

        if (!file_exists($this->diretorio) && !is_dir($this->diretorio)) {
            mkdir($this->diretorio, 0755);
        }
    }

    /**
     * Realiza a validação e o envio dos arquivos
     *
     * @param  mixed $arquivo
     * @param  mixed $nome
     * @param  mixed $subDiretorio
     * @param  mixed $tamanho
     * @return void
     */
    public function arquivo(array $arquivo, ?string $nome = null, ?string $subDiretorio = null, ?int $tamanho = null)
    {
        $this->arquivo = $arquivo;
        $this->tamanho = $tamanho ?? 1;
        $this->nome = $nome ?? pathinfo($this->arquivo['name'], PATHINFO_FILENAME);
        $this->subDiretorio = $subDiretorio ?? 'arquivos';

        $extensao = pathinfo($this->arquivo['name'], PATHINFO_EXTENSION);
        $tipo = $this->arquivo['type'];




        if (validaArquivo($extensao, $tipo, $this->tamanho)) {
            $this->createSubDiretorio();
            $this->renomearArquivo();
            $this->uploadArquivo();
        }
    }

    /**
     * Cria sub diretório dentro do diretório padrão
     * @return void
     */
    private function createSubDiretorio(): void
    {
        if (!file_exists($this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio) && !is_dir($this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio)) {
            mkdir($this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio, 0755);
        }
    }

    /**
     * Renomeia o arquivo recebido para manter um padrão
     * 
     * @return void
     */
    private function renomearArquivo(): void
    {
        $arquivo = $this->nome . strrchr($this->arquivo['name'], '.');
        if (file_exists($this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio . DIRECTORY_SEPARATOR . $arquivo)) {
            $arquivo = $this->nome . '-' . uniqid() . strrchr($this->arquivo['name'], '.');
        }
        $this->nome = $arquivo;
    }

    /**
     *  Enviar o arquivo recebido ao diretório
     * @return void
     */
    private function uploadArquivo(): void
    {
        if (move_uploaded_file($this->arquivo['tmp_name'], $this->diretorio . DIRECTORY_SEPARATOR . $this->subDiretorio . DIRECTORY_SEPARATOR . $this->nome)) {
            $this->result =  $this->nome;
        } else {
            $this->result = null;
            $this->erro = 'Erro ao enviar arquivo';
        }
    }


    /**
     * Valida o arquivo recebido
     *
     * @param  mixed $extensao
     * @param  mixed $tipo
     * @param  mixed $tamanho
     * @return bool
     */
    private function validaArquivo(?string $extensao, ?string $tipo, ?int $tamanho = null): bool
    {
        $extensoesValidas = ['pdf', 'png', 'jpg', 'jpeg'];

        $tiposValidos = ['application/pdf', 'text/plain', 'image/png', 'image/jpg', 'image/jpeg'];

        if (!in_array($extensao, $extensoesValidas)) {
            $this->erro = "Extensão de arquivo(" . $extensao . ") não permitido. Extensões válidas: " . implode(' .', $extensoesValidas);
            return false;
        }
        if (!in_array($this->arquivo['type'], $tiposValidos)) {
            $this->erro = "Tipo de arquivo(" . $tipo . ") não permitido. Tipos válidos: " . implode(' .', $tiposValidos);
            return false;
        }
        if ($this->arquivo['size'] > $tamanho * (1024 * 1024)) {
            $this->erro = "O tamanho do arquivo excedeu o limite permitido(tamanho do seu arquivo {$tipo}MB). O limite é: {$tamanho}MB";
            return false;
        }
        return true;
    }
}
