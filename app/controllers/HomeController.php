<?php


namespace app\controllers;

use app\controllers\BaseController;
use app\database\models\UserModel;

class HomeController extends BaseController
{

    public function index($request, $response)
    {
        $user = new UserModel();
        $users = $user->findAll();
        var_dump($users);
        die();
        return $this->getTwig()->render($response, $this->setView('site/home'), [
            'title' => 'Curso de Slim 4'
        ]);
    }

}