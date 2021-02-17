<?php

namespace app\traits;

use PDOException;

trait Read
{
    public function find($fetchAll = false)
    {
        try {
            $query = $this->connection->query("select * from {$this->table}");
            return ($fetchAll) ? $query->fetchAll() : $query->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function findBy($field, $value, $fetchAll = false)
    {
        try {
            $prepared = $this->connection->prepare("select * from {$this->table} where {$field} = :{$field} ");
            $prepared->bindValue(":{$field}", $value);
            $prepared->execute();
            return ($fetchAll) ? $prepared->fetchAll() : $prepared->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
