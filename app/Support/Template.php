<?php

namespace app\Support;

use app\Core\Helpers;
use Jenssegers\Blade\Blade;

class Template
{

    private Blade $blade;

    public function __construct(string $diretorioViews, string $diretorioCache)
    {
        require_once 'app\Core\Helpers.php';
        // Limpa o cache antes de cada renderização (não recomendado em produção)
        array_map('unlink', glob($diretorioCache . '/*'));

        $this->blade = new Blade($diretorioViews, $diretorioCache);
    }

    public function renderizar(string $view, array $dados): string
    {
        return $this->blade->make($view, $dados)->render();
    }

    public function flash()
    {
        return Helpers::flash();
    }
}
