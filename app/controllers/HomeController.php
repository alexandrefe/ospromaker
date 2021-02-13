<?php


namespace app\controllers;

use app\controllers\BaseController;

class HomeController extends BaseController
{

    public function index($request, $response, $args)
    {
        return redirect($response, '/loginform');
    }
}