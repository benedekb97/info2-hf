<?php

namespace Auto;

use Auto\Models\Car;
use Auto\Models\User;

$user = User::find(Request::get('user'));
$car = Car::find(Request::get('car'));

if(!isset($current_user)){
    header("Location: ".Router::getLink('index.login'));
    die();
}

if(($current_user == $user && in_array($car, $user->getCars())) || $current_user->isAdmin()){
    $car->delete();

    if(Request::post('return_to') != false){
        header("Location: ".Router::getLink(Request::post('return_to')));
        die();
    }
    header("Location: ".Router::getLink('user.cars', ['user' => $user->getId()]));
    die();
}else{
    header("Location: ".Router::getLink('index'));
    die();
}