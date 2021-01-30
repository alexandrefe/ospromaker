<?php


namespace app\database;

use PDO;
use PDOException;


class Connection
{

    private static $pdo;

    public static function connection()
    {
        if(static::$pdo) {
            return static::$pdo;
        }

        $config =  require dirname(__FILE__, 2) . '/helpers/dbconfig.php';

        $local    = $config['db']['host'];
        $db       = $config['db']['dbname'];
        $user     = $config['db']['username'];
        $password = $config['db']['password'];

        try{

            static::$pdo = new PDO("mysql:host={$local}; dbname={$db}", "{$user}", "$password",
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]
            );

            return static::$pdo;

        } catch(PDOException $e) {

            var_dump($e->getMessage());

        }
    }

}