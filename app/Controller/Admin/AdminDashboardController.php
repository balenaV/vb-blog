<?php

namespace app\Controller\Admin;

class AdminDashboardController extends AdminController
{

    public function dashboard(): void
    {
        echo $this->template->renderizar(
            'dashboard',
            []
        );
    }
}
