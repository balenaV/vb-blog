<?php

use infinit\Nucleo\Helpers;
use Pecee\SimpleRouter\SimpleRouter;

try {
    SimpleRouter::setDefaultNamespace("infinit\Controlador");

    SimpleRouter::get(URL_BASE, "SiteControlador@index");

    SimpleRouter::get(URL_BASE . "/sobre-nos", "SiteControlador@sobre");
    SimpleRouter::get(URL_BASE . "/post/{id}", "SiteControlador@post");
    SimpleRouter::get(URL_BASE . "/categoria/{id}", "SiteControlador@categoria");
    SimpleRouter::post(URL_BASE . "/buscar", "SiteControlador@buscar");
    SimpleRouter::post(URL_BASE . "/busca", "SiteControlador@busca");

    SimpleRouter::get(URL_BASE . "/404", "SiteControlador@erro404");

    SimpleRouter::start();
} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $ex) {

    if (Helpers::localhost()) {
        echo  'Página não encontrada <br>' . $ex;
    } else
        Helpers::redirecionar('404');
}
