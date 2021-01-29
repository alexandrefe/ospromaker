<?php

// Variaveis globais

define('ROOT', dirname(__FILE__, 3));
define('DIR_VIEWS', ROOT . '/app/views/');
define('EXT_VIEWS', '.html');

// Configuracao do banco de dados

return [
    "db" => [
        'host'=> 'localhost',
        'dbname' => 'slim4',
        'username' => 'root',
        'password' => '',
    ],
];