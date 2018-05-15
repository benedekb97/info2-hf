<?php

namespace Auto;

use Auto\Models\Car;
use Auto\Models\Service;
use Auto\Models\User;

$user = User::find(Request::get('user'));

if(!isset($current_user)){
    Router::redirect('index.login');
    die();
}

if(!$current_user->isMechanic()){
    Router::redirect('index');
}

if($user == $current_user || $current_user->isAdmin()){
    $car = Car::find(Request::post('car'));
    $fixer = $user;
    $cost = Request::post('cost');
    $description = Request::post('description');

    Service::create($car, $fixer, $cost, $description);

    Router::redirect('user.fixes', ['user' => $current_user]);
}

Router::redirect('user.fixes', ['user' => $current_user]);
