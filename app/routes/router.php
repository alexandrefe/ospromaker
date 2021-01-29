<?php

use app\controllers\HomeController;

$app->get('/', HomeController::class.':index');
