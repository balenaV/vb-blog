<?php

namespace app\Controller\Admin;

use app\Model\PostModel;

class AdminPostsController extends AdminController
{

    public function index($id): void
    {
        $posts = (new PostModel())->getByUser($id);

        echo $this->template->renderizar(
            'posts/index',
            []
        );
    }
}
