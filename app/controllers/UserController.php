<?php


namespace app\controllers;

use app\classes\Flash;
use app\classes\Validate;
use app\controllers\BaseController;
use app\database\models\UserModel;

class UserController extends BaseController
{

    private $users;
    private $validate;

    public function __construct()
    {
        $this->users = new UserModel();
        $this->validate = new Validate();
    }

    public function index($request, $response)
    {
        $users = $this->users->find(true);

        return $this->getTwig()->render($response, $this->setView('admin/users'), [
            'title' => 'OSPROMAKER - Funcionários/Usuários',
            'users' => $users,
        ]);
    }

    public function showStoreForm($request, $response, $args)
    {
        $messages = Flash::getAll();

        return $this->getTwig()->render($response, $this->setView('admin/forms/users_store'), [
            'title' => 'OSPROMAKER - Cadastro de Usuários',
            'messages' => $messages,
        ]);
    }

    public function store($request, $response, $args)
    {
        $values = [
            'email'=> $_POST['email'],
            'name' => $_POST['name']
        ];

        // Como passar mais de um campo para verificar se já existe ?

        $this->validate->required(['name', 'email', 'cpf', 'position', 'password'])->exists($this->users, ['name', 'email'], $values);
        $errors = $this->validate->getErrors();

        if($errors) {
            Flash::flashes($errors);
            return redirect($response, '/admin/users/store');
        }

    }

    public function showUpdateForm($request, $response, $args)
    {
        return $this->getTwig()->render($response, $this->setView('admin/forms/users_store'), [
            'title' => 'OSPROMAKER - Cadastro de Usuários',
        ]);
    }

    public function update($request, $response, $args)
    {
        return $this->getTwig()->render($response, $this->setView('admin/forms/users_update'), [
            'title' => 'OSPROMAKER - Ataulize Cadastro',
        ]);
    }

    public function destroy($request, $response, $args)
    {

    }


}