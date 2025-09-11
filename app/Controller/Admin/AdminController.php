<?php

namespace app\Controller\Admin;

use app\Core\Controller;

class AdminController extends Controller
{

    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../../layouts/admin/views');
    }
}
