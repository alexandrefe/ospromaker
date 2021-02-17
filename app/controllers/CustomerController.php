<?php

namespace app\controllers;

use app\classes\Flash;
use app\classes\Validate;
use app\controllers\BaseController;
use app\database\models\CustomerModel;

class CustomerController extends BaseController
{
    private $customer;
    private $validate;

    public function __construct()
    {
        $this->customer = new CustomerModel;
        $this->validate = new Validate;
    }

    public function index($request, $response)
    {
        $messages = Flash::getAll();
        
        $customers = $this->customer->find(true);

        return $this->getTwig()->render($response, $this->setView('admin/customers'), [
          'title' => 'OSPROMAKER - Clientes',
          'customers' => $customers,
          'messages' => $messages,
        ]);
    }

    public function showStoreForm($request, $response)
    {
        $messages = Flash::getAll();
        
        return $this->getTwig()->render($response, $this->setView('admin/forms/customer_store'), [
          'title' => 'OSPROMAKER - Clientes',
          'messages' => $messages,
        ]);
    }

    public function store($request, $response)
    {
        $values = [
          'name' => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
          'cpf' => filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING),
          'rg' => filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_STRING),
          'birth_date' => filter_input(INPUT_POST, 'birth_date', FILTER_SANITIZE_STRING),
          'address' => filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING),
          'tel' => filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING),
          'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING),
       ];

       $this->validate->required(['name', 'cpf', 'rg', 'birth_date', 'address', 'tel', 'email'])->exists($this->customer, ['name', 'cpf'], $values);
       $errors = $this->validate->getErrors();

       $created = $this->customer->create($values);

       if($created) {
           Flash::set('message', "Cliente {$values['name']}, cadastrado com sucesso!", 'success');
           return redirect($response, '/admin/customers');
       } else {
           Flash::set('message', 'Ocorreu um erro ao cadastrar!', 'danger');
           return redirect($response, '/admin/customers/showStoreForm');
       }

       return $response;
    }

}
