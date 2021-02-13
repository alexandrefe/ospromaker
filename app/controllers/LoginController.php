<?php


namespace app\controllers;

use app\classes\Login;
use app\classes\Flash;
use app\classes\Validate;
use app\controllers\BaseController;


class LoginController extends BaseController
{

    private $login;

    public function __construct()
    {
        $this->login = new Login;
    }

    public function showLoginForm($request, $response, $args)
    {

        $messages = Flash::getAll();

        return $this->getTwig()->render($response, $this->setView('admin/forms/login_form'), [
            'title' => 'OSPROMAKER - Tela de Login',
            'messages' => $messages,
        ]);
    }

    public function store($request, $response, $args)
    {
        $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $validate = new Validate();
        $validate->required(['email', 'password'])->email($email);
        $erros = $validate->getErrors();

        if($erros) {
            Flash::flashes($erros);
            return redirect($response, '/loginform');
        }

        $logged = $this->login->login($email, $password);

        if($logged) {
            return redirect($response, '/admin');
        } else {
            Flash::set('message', 'Ocorreu um erro ao logar!', 'danger');
            return redirect($response, '/login');
        }

    }

    public function destroy($request, $response)
    {
        $this->login->logout();
        return redirect($response, '/');
    }
}