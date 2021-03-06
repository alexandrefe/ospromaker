<?php

use app\controllers\HomeController;
use app\controllers\ServiceOrderController;
use app\controllers\CustomerController;
use app\controllers\UserController;
use app\controllers\AdminController;
use app\controllers\ErrorController;
use app\controllers\LoginController;

use Slim\Routing\RouteCollectorProxy;

require dirname(__FILE__, 2) . '/middlewares/logged.php';

$app->get('/', HomeController::class .':index');

$app->get('/loginform', LoginController::class.':showLoginForm');
$app->post('/login', LoginController::class.':store');
$app->get('/logout', LoginController::class.':destroy');

$app->group('/admin', function (RouteCollectorProxy $group) {
    
    $group->get('/', AdminController::class .':index');

    $group->get('/serviceorders', ServiceOrderController::class.':index');

    $group->get('/customers', CustomerController::class.':index');
    $group->get('/customers/storeform', CustomerController::class.':showStoreForm');
    $group->post('/customers/store', CustomerController::class.':store');
    $group->get('/customers/updateform/{id}', CustomerController::class.':showUpdateForm');
    $group->put('/customers/update/{id}', CustomerController::class.':update');
    $group->delete('/customers/destroy/{id}', CustomerController::class.':destroy');

    $group->get('/users', UserController::class .':index');
    $group->get('/users/storeform', UserController::class .':showStoreForm');
    $group->post('/users/store', UserController::class .':store');
    $group->get('/users/updateform/{id}', UserController::class.':showUpdateForm');
    $group->put('/users/update/{id}', UserController::class.':update');
    $group->delete('/users/destroy/{id}', UserController::class.':destroy');

})->add($logged);


$app->get('/error', ErrorController::class.':index');
