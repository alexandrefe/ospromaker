<?php

namespace app\database\models;

use app\database\models\BaseModel;

class ServiceOrderModel extends BaseModel
{
	protected $table = 'serviceorders';

	public function serviceOrders($searched)
	{

		try {

            $prepared = $this->connection->prepare(
                "SELECT SQL_CALC_FOUND_ROWS * FROM serviceorders INNER JOIN customers ON (serviceorders.id_customer = customers.id) 
					WHERE serviceorders.title LIKE :searchTitle OR customers.name LIKE :searchName LIMIT {$this->limit} OFFSET {$this->offset}"
            );

            $prepared->bindValue(':searchTitle', "%{$searched}%");
            $prepared->bindValue(':searchName',  "%{$searched}%");
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