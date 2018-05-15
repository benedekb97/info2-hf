<?php

namespace Auto;

use Auto\Models\User;

session_start();

Base::db_connect('localhost', 'root', '', 'auto');

Request::create();

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
    $current_user = new User($_SESSION['user_id']);
}

require_once 'routes.php';
