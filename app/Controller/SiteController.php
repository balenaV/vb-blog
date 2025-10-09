<?php

namespace app\Controller;

use app\Core\Controller;
use app\Core\Helpers;
use app\Model\CategoriaModel;
use app\Model\PostModel;
use app\Controller\UsuarioController;
use app\Core\Session;

use DateTime;

class SiteController extends Controller
{

    protected $usuarioSessao;

    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../layouts/site/views');

        $this->usuarioSessao = UsuarioController::usuario();

        if (!$this->usuarioSessao) {
            $this->mensagem->erro('Faça login para acessar o painel de controle!')->flash();

            $sessao = new Session();
            $sessao->clear('usuarioId');

            Helpers::redirecionar('admin/login');
        }
    }

    public function index(): void
    {
        $posts      = (new PostModel())->getAll(' status = 1');
        $categorias = (new CategoriaModel())->getAll(' status = 1');

        echo $this->template->renderizar('index', [
            'posts'      => $posts->result(true),
            'categorias' => $categorias->result(true),
            'usuarioSessao' => $this->usuarioSessao
        ]);
    }

    public function post(string $slug): void
    {
        $post = (new PostModel())->getBySlug($slug);

        if (! $post) {
            Helpers::redirecionar('404');
        }
        $post->visitas++;
        $post->ultimaVisita = (new DateTime())->format('Y-m-d H:i:s');
        $post->save();

        echo $this->template->renderizar('post', [
            'post'       => $post,
            'categorias' => (new CategoriaModel())->getAll()->result(true),
            'usuarioSessao' => $this->usuarioSessao
        ]);
    }

    public function categoria(int $id): void
    {
        $categoria = (new CategoriaModel())->getById($id);

        if (! $categoria) {
            Helpers::redirecionar('404');
        }

        echo $this->template->renderizar('categoria', [
            'posts'      => (new PostModel())->getAll(" categoriaId = $id")->result(true),
            'categoria'  => $categoria,
            'categorias' => (new CategoriaModel())->getAll()->result(true),
            'usuarioSessao' => $this->usuarioSessao
        ]);
    }
    public function sobre(): void
    {
        echo $this->template->renderizar('sobre', [
            'titulo' => 'Sobre Nós',
        ]);
    }

    public function buscar(): void
    {
        $busca = filter_input(INPUT_POST, 'busca', FILTER_DEFAULT);

        if (isset($busca)) {
            $posts = (new PostModel())->getAll(" status = 1 AND titulo LIKE '%$busca%'")->result(true);

            if (! empty($posts)) {
                foreach ($posts as $post) {
                    echo "<div class='p-2 border-bottom'>
                        <a href= 'post/{$post->id}'>{$post->titulo}</a>
                      </div>";
                }
            } else {
                echo "<div class='alert alert-warning m-2' role='alert'>
                    Não há nenhum post registrado sobre
                    <strong>" . Helpers::resumirTexto(htmlspecialchars($busca), 15) . "</strong>
                  </div>";
            }
        }
    }

    public function busca(): void
    {
        $busca = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($busca)) {
            $posts = (new PostModel())->getAll(" status = 1 AND titulo LIKE '%" . $busca['busca'] . "%'")->result(true);

            echo $this->template->renderizar('busca', [
                'posts'      => $posts,
                'categorias' => (new CategoriaModel())->getAll()->result(true),
                'pesquisa'   => $busca['busca'],
                'usuarioSessao' => $this->usuarioSessao
            ]);
        }
    }

    public function erro404(): void
    {
        echo $this->template->renderizar('404', [
            'titulo' => 'Página não encontrada',
            'usuarioSessao' => $this->usuarioSessao
        ]);
    }
}
