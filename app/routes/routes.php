<?php

use app\controllers\HomeController;
use app\controllers\AdminController;
use app\controllers\UserController;
use app\controllers\ErrorController;



$app->get('/', HomeController::class . ':index');


$app->get('/admin', AdminController::class.':index');
$app->get('/admin/users', UserController::class.':index');
$app->get('/admin/users/store', UserController::class.':showStoreForm');
$app->post('/admin/users/store', UserController::class.':store');
$app->get('/admin/users/update', UserController::class.':showUpdateForm');
$app->post('/admin/users/update', UserController::class.':update');
$app->delete('/admin/users/destroy', UserController::class.':destroy');



$app->get('/error', ErrorController::class.':index');
