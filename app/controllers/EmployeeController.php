<?php


namespace app\controllers;

use app\controllers\BaseController;
use app\database\models\UserModel;

class EmployeeController extends BaseController
{

    private $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function index()
    {
        $users = $this->users->find(true);

        return $this->getTwig()->render($response, $this->setView('admin/employee'), [
            'title' => 'OSPROMAKER - Funcionários/Usuários',
            'info' => 'Os usários também são funcionários!',
            'users' => $users
        ]);
    }
}