<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Middleware\MethodOverrideMiddleware;

$app = AppFactory::create();

require '../app/helpers/twig_variables.php';

require '../app/routes/routes.php';

$MethodOverrideMiddleware = new MethodOverrideMiddleware();
$app->add($MethodOverrideMiddleware);

$app->map(['GET', 'POST', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response){
    return redirect($response, '/error', 404);
});

$app->run();