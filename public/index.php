<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

require '../app/helpers/config.php';
require '../app/routes/router.php';


$app->run();