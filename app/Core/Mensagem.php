<?php

namespace infinit\Nucleo;

class Mensagem
{
    private string $texto;
    private string $css;


    public function __toString()
    {
        return $this->renderizar();
    }

    public function succeso(string $mensagem): Mensagem
    {
        $this->css = 'alert alert-success';
        $this->texto = $this->filtrar($mensagem);

        return $this;
    }

    public function erro(string $mensagem): Mensagem
    {
        $this->css = 'alert alert-danger';
        $this->texto = $this->filtrar($mensagem);

        return $this;
    }

    public function alerta(string $mensagem): Mensagem
    {
        $this->css = 'alert alert-warning';
        $this->texto = $this->filtrar($mensagem);

        return $this;
    }

    /**
     * Método responsável pela renderização das mensagens
     * @return string retorna a mensagem renderizada
     */
    public function renderizar(): string
    {
        return "<div class='{$this->css}'>{$this->texto}</div>";
    }

    /**
     * Método responsável por filtrar as mensagens
     * @return string retorna a mensagem filtrada
     */
    private function filtrar(string $mensagem): string
    {
        return filter_var($mensagem, FILTER_DEFAULT);
    }
}
