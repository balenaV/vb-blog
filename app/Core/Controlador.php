<?php

namespace infinit\Nucleo;

use infinit\Suporte\Template;

class Controlador
{
    protected Template $template;

    public function __construct(string $diretorioViews)
    {
        // Corrigido: Construa o caminho do cache de forma absoluta e diferente do caminho de views
        $cacheDir = __DIR__ . '/../cache'; // Crie uma pasta 'cache' na raiz do seu projeto

        // Crie o diretório de cache se ele não existir
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }

        $this->template = new Template($diretorioViews, $cacheDir);
    }
}
