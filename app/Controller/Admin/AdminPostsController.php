<?php

namespace app\Controller\Admin;

use app\Model\PostModel;

class AdminPostsController extends AdminController
{

    public function index(): void
    {
        $posts = (new PostModel())->getAllWithInactive();

        echo $this->template->renderizar(
            'posts/index',
            [
                'posts' => $posts
            ]
        );
    }
}
