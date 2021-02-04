<?php

namespace app\traits;

use PDOException;

trait Create
{

    public function create(array $fieldAndValues)
    {
        try {
            // O primeiro %s é a tabela, o segundo
            // é o field(campo) e o ultimo é o valor

            $sql = sprintf("insert into %s (%s) values(%s)", $this->table, implode(', ', array_keys($fieldAndValues)), ':' . implode(', :', array_keys($fieldAndValues)));
            $prepared = $this->connection->prepare($sql);
            return $prepared->execute($fieldAndValues);
            dd($sql);

        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}