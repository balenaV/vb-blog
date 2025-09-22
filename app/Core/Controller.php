<?php

namespace app\Core;

use app\Support\Template;

class Controller
{
    protected Template $template;
    protected Mensagem $mensagem;

    public function __construct(string $diretorioViews)
    {
        // Corrigido: Construa o caminho do cache de forma absoluta e diferente do caminho de views
        $cacheDir = __DIR__ . '/../cache'; // Crie uma pasta 'cache' na raiz do seu projeto

        // Crie o diretório de cache se ele não existir
        if (! is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }

        $this->template = new Template($diretorioViews, $cacheDir);

        $this->mensagem = new Mensagem();
    }
}
