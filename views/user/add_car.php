<?php

namespace Auto;

use Auto\Models\Car;
use Auto\Models\User;

$user = User::find(Request::get('user'));

if(!isset($current_user)){
    Router::redirect('index.login');
    die();
}

if($user == $current_user || $current_user->isAdmin()){
    Car::create(Request::post('type'), Request::post('age'), Request::post('technical_exam_year'), $user);

    Router::redirect('user.cars', ['user' => $user]);
}else{
    Router::redirect('index');
}
