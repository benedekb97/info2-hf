<?php

namespace Auto;

use Auto\Models\User;

require_once 'Base.php';
require_once 'Models/Car.php';
require_once 'Models/User.php';
require_once 'Models/Service.php';
require_once 'Request.php';
require_once 'Router.php';

session_start();

Base::db_connect('localhost', 'root', '', 'auto');

Request::create();

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
    $current_user = new User($_SESSION['user_id']);
}

require_once 'routes.php';
