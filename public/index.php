<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$basePath = str_replace('/' . basename(__FILE__), '', $_SERVER['SCRIPT_NAME']);
$app = $app->setBasePath($basePath);

$app->addErrorMiddleware(true, true, true);

require '../app/helpers/config.php';
require '../app/routes/router.php';


$app->run();