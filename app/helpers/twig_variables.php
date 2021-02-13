<?php

use app\classes\TwigGlobal;

TwigGlobal::set('logged_in', $_SESSION['is_logged_in'] ?? '');
TwigGlobal::set('user', $_SESSION['user_logged_data'] ?? '');
