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

    // Tentar fazer a existe suporta array de campos e values para verificar se existe no campo
    // exemplo nome e email
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

    public function getErrors()
    {
        return $this->errors;
    }
}