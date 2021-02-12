<?php


namespace app\controllers;

use app\classes\Flash;
use app\classes\Validate;
use app\controllers\BaseController;
use app\database\models\UserModel;

class UserController extends BaseController
{

    private $user;
    private $validate;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->validate = new Validate();
    }

    public function index($request, $response)
    {
        $messages = Flash::getAll();

        $users = $this->user->find(true);

        return $this->getTwig()->render($response, $this->setView('admin/users'), [
            'title' => 'OSPROMAKER - Funcionários/Usuários',
            'users' => $users,
            'messages' => $messages,
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
            'name' => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING),
            'cpf' => filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING),
            'position' => filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING),
            'password' => password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT),
        ];

        $this->validate->required(['name', 'email', 'cpf', 'position', 'password'])->exists($this->user, ['email', 'cpf'], $values);
        $errors = $this->validate->getErrors();

        if($errors) {
            Flash::flashes($errors);
            return redirect($response, '/admin/users/storeform');
        }

        $created = $this->user->create($values);

        if($created) {
            Flash::set('message', "Usuário {$values['name']}, cadastrado com sucesso!", 'success');
            return redirect($response, '/admin/users');
        } else {
            Flash::set('message', 'Ocorreu um erro ao cadastrar!', 'danger');
            return redirect($response, '/admin/users/store');
        }


        return $response;

    }

    public function showUpdateForm($request, $response, $args)
    {
        $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);

        $user = $this->user->findBy('id', $id);

        if(!$user) {
            Flash::set('message', 'Usuário não existe!', 'danger');
            return redirect($response, '/admin/users');
        }

        $messages = Flash::getAll();

        return $this->getTwig()->render($response, $this->setView('admin/forms/users_update'), [
            'title' => 'OSPROMAKER - Cadastro de Usuários',
            'user' => $user,
            'messages' => $messages,
        ]);
    }

    public function update($request, $response, $args)
    {
        $name     = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $cpf      = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
        $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
        $id       = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);


        $this->validate->required(['name', 'email', 'cpf', 'position']);
        $errors = $this->validate->getErrors();

        if($errors) {
            Flash::flashes($errors);
            return redirect($response, '/admin/users/updateform/' . $id);
        }

        $updated = $this->user->update(['fields' => ['name' => $name, 'email' => $email, 'cpf' => $cpf, 'position' => $position], 'where' => ['id' => $id]]);

        if($updated) {
            Flash::set('message', "Usuário(a) {$name}, atualizado com sucesso!", 'success');
            return redirect($response, '/admin/users');
        } else {
            Flash::set('message', 'Ocorreu algum erro ao atualizar!', 'danger');
            return redirect($response, '/admin/users');
        }

    }

    public function destroy($request, $response, $args)
    {
        $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);

        $user = $this->user->findBy('id', $id);

        if(!$user) {
            Flash::set('message', 'Usuário não existe!', 'danger');
            return redirect($response, '/admin/users');
        }

        $deleted = $this->user->delete('id', $id);

        if ($deleted) {
            Flash::set('message', "Usuário(a), deletado com sucesso!", 'success');
            return redirect($response, '/admin/users');
        } else {
            Flash::set('message', "Ocorreu um erro ao deletar!", 'success');
            return redirect($response, '/admin/users', 'danger');
        }

    }


}