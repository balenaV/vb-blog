<?php

use app\Core\Helpers;
use Pecee\SimpleRouter\SimpleRouter;

try {
    SimpleRouter::setDefaultNamespace("app\Controller");

    SimpleRouter::get(URL_BASE, "SiteController@index");

    SimpleRouter::get(URL_BASE . "/sobre-nos", "SiteController@sobre");
    SimpleRouter::get(URL_BASE . "/post/{id}", "SiteController@post");
    SimpleRouter::get(URL_BASE . "/categoria/{id}", "SiteController@categoria");
    SimpleRouter::post(URL_BASE . "/buscar", "SiteController@buscar");
    SimpleRouter::post(URL_BASE . "/busca", "SiteController@busca");

    SimpleRouter::get(URL_BASE . "/404", "SiteController@erro404");

    SimpleRouter::group(['namespace' => 'Admin'], function () {
        SimpleRouter::get(URL_ADMIN . '/dashboard', 'AdminDashboardController@dashboard');

        // ADMIN POSTS
        SimpleRouter::get(URL_ADMIN . '/posts/index', 'AdminPostsController@index');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . '/posts/create', 'AdminPostsController@create');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . '/posts/edit/{id}', 'AdminPostsController@edit');

        // ADMIN CATEGORIAS
        SimpleRouter::get(URL_ADMIN . '/categorias/index', 'AdminCategoriasController@index');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . '/categorias/create', 'AdminCategoriasController@create');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . '/categorias/edit/{id}', 'AdminCategoriasController@edit');
    });

    SimpleRouter::start();
} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $ex) {

    if (Helpers::localhost()) {
        echo 'Página não encontrada <br>' . $ex;
    } else {
        Helpers::redirecionar('404');
    }
}
