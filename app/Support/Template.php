<?php

namespace infinit\Suporte;

use Jenssegers\Blade\Blade;

class Template
{

    private Blade $blade;

    public function __construct(string $diretorioViews, string $diretorioCache)
    {
        require_once 'infinit\Nucleo\Helpers.php';
        // Limpa o cache antes de cada renderização (não recomendado em produção)
        array_map('unlink', glob($diretorioCache . '/*'));

        $this->blade = new Blade($diretorioViews, $diretorioCache);
    }

    public function renderizar(string $view, array $dados): string
    {
        return $this->blade->make($view, $dados)->render();
    }
}
