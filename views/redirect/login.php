<?php

namespace Auto;

use Auto\Models\User;

if(User::authenticate(Request::post('email'), Request::post('password'))){
    $email = Request::post('email');
    $password = Request::post('password');

    $_SESSION['user_id'] = User::findByEmail($email)->getId();

    header("Location: ".Router::getLink('index'));
    die();
}else{
    header("Location: ".Router::getLink('index.login'));
}