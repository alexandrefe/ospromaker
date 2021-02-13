<?php


namespace app\classes;


class Validate
{

    private $errors = [];

    public function required(array $fields)
    {
        foreach ($fields as $field) {
         if (empty($_POST[$field])) {
           $this->errors[$field] = "Campo obrigatório";
         }
        }

        return $this;
    }

    public function exists($model, array $fields, array $values)
    {
        foreach ($fields as $field) {
            foreach ($values as $value) {
                $data = $model->findBy($field, $value);
                if ($data) {
                    $this->errors[$field] = 'Esse registro já existe';
                }
            }
        }

        return $this;
    }

    public function email($email)
    {
        $validated = filter_Var($email, FILTER_VALIDATE_EMAIL);
        if(!$validated) {
            $this->errors['email'] = 'Email inválido';
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}