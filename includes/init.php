<?php

namespace Auto;

use Auto\Models\User;

session_start();

include('functions.php');

Base::db_connect(env('MYSQL_HOST'), env('MYSQL_USER'), env('MYSQL_PASSWORD'), env('MYSQL_DATABASE'));

Request::create();

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
    $current_user = new User($_SESSION['user_id']);
}

require_once 'routes.php';
