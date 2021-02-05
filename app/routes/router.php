<?php

use app\controllers\AdminController;
use app\controllers\EmployeeController;


$app->get('/admin', AdminController::class.':index');
$app->get('/admin/employee', EmployeeController::class.':index');
