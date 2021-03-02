<?php

namespace app\database\models;

use Exception;

class CustomerModel extends BaseModel
{

    protected $table = 'customers';


    public function customers($searched)
    {

        try {

            $prepared = $this->connection->prepare(
                "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} WHERE 
                    customers.name LIKE :searchName 
                        OR customers.cpf LIKE :searchCpf 
                            LIMIT {$this->limit} OFFSET {$this->offset}"
            );

            $prepared->bindValue(':searchName', "%{$searched}%");
            $prepared->bindValue(':searchCpf', "%{$searched}%");
            $prepared->execute();

            return 
            [
                'registers' => $prepared->fetchAll(),
                'total' => $this->connection->query('SELECT FOUND_ROWS()')->fetchColumn()
            ];

        } catch (Exception $e) {

            var_dump($e->getMessage());
        }
    }

}
