<?php

use app\controllers\HomeController;
use app\controllers\AdminController;
use app\controllers\UserController;
use app\controllers\ErrorController;



$app->get('/', HomeController::class . ':index');


$app->get('/admin', AdminController::class.':index');
$app->get('/admin/users', UserController::class.':index');
$app->get('/admin/users/storeform', UserController::class.':showStoreForm');
$app->post('/admin/users/store', UserController::class.':store');
$app->get('/admin/users/updateform/{id}', UserController::class.':showUpdateForm');
$app->put('/admin/users/update/{id}', UserController::class.':update');
$app->delete('/admin/users/destroy', UserController::class.':destroy');



$app->get('/error', ErrorController::class.':index');
