<?php


namespace app\database\models;

use PDOException;
use app\database\Connection;

class UserModel
{

    private $connection;
    protected $table = 'users';

    public function __construct()
    {
        $this->connection = Connection::connection();
    }

    public function findAll()
    {
        try{
            $query = $this->connection->query("SELECT * FROM {$this->table}");
            return $query->fetchAll();
        } catch(PDOException $e) {
            var_dump($e->getMessage());
        }
    }

}