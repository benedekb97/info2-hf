<?php

namespace Auto;

use Auto\Models\Car;
use Auto\Models\User;

$user = User::find(Request::get('user'));

if(!isset($current_user)){
    header("Location: ".Router::getLink('index.login'));
    die();
}

if($user == $current_user || $current_user->isAdmin()){
    Car::create(Request::post('type'), Request::post('age'), Request::post('technical_exam_year'), $user);

    header("Location: ".Router::getLink('user.cars', ['user' => $user->getId()]));
}else{
    header("Location: ".Router::getLink('index'));
}
