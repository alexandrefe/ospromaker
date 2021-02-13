<?php


namespace app\controllers;

use app\controllers\BaseController;
use app\database\models\UserModel;

class AdminController extends BaseController
{

    public function index($request, $response)
    {
        return $this->getTwig()->render($response, $this->setView('admin/home'), [
            'title' => 'OSPROMAKER',
        ]);
    }
}