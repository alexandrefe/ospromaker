<?php


namespace app\controllers;

use app\controllers\BaseController;

class HomeController extends BaseController
{

    public function index($request, $response, $args)
    {
        $response->getBody()->write("OSPROMAKER, Realize seu login");
        return $response;
    }
}