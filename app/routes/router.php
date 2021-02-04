<?php

use app\controllers\AdminController;
use app\controllers\EmployeeController;

$app->get('/admin/', AdminController::class.':index')->setName('admin');
$app->get('/admin/employee', EmployeeController::class.':index')->setName('admin.employee');
