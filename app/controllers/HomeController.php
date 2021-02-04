<?php


namespace app\controllers;

use app\controllers\BaseController;
use app\database\models\UserModel;

class HomeController extends BaseController
{

    private $user;

    public function __construct() {
        $this->user = new UserModel();
    }

    public function index($request, $response)
    {

        $deleted = $this->user->delete('id', 3);

        dd($deleted);

        die();

        return $this->getTwig()->render($response, $this->setView('site/home'), [
            'title' => 'Curso de Slim 4',

        ]);
    }

}