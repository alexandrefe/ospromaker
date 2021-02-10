<?php


namespace app\controllers;

use app\controllers\BaseController;

class ErrorController extends BaseController
{

    public function index($request, $response, $args)
    {
        return $this->getTwig()->render($response, $this->setView('admin/error'));
    }

}