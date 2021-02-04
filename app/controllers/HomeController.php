<?php


namespace app\controllers;

use app\controllers\BaseController;
use app\database\models\UserModel;

class HomeController extends BaseController
{

    private $user;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index($request, $response)
    {

        $updated = $this->userModel->update([
            'fields' => ['firstname' => 'Carlos', 'email' => 'joana@email.com'],
            'where'  => ['id' => 3]
        ]);

        dd($updated);


        return $this->getTwig()->render($response, $this->setView('site/home'), [
            'title' => 'Curso de Slim 4',

        ]);
    }

}