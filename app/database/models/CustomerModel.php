<?php

namespace app\database\models;

class CustomerModel extends BaseModel
{
    public $table = 'customers';

    public function searchCostumer($searched)
    {
        try {
            $prepared = $this->connection->prepare(
             "SELECT * FROM {$this->table} WHERE customers.name LIKE :searchName OR customers.cpf LIKE :searchCpf ");
            $prepared->bindValue(':searchName', "%{$searched}%");
            $prepared->bindValue(':searchCpf', "%{$searched}%");
            $prepared->execute();
            return $prepared->fetchAll();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
