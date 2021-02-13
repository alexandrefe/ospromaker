<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Middleware\MethodOverrideMiddleware;
use Slim\Routing\RouteCollectorProxy;

$app = AppFactory::create();

require '../app/routes/routes.php';

$MethodOverrideMiddleware = new MethodOverrideMiddleware();
$app->add($MethodOverrideMiddleware);

$app->map(['GET', 'POST', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response){
    return redirect($response, '/error', 404);
});

$app->run();