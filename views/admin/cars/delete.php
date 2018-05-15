<?php

namespace Auto;


use Auto\Models\Car;

if(!isset($current_user) || !$current_user->isAdmin()){
    Router::redirect('index.login');
    die();
}

$car = Car::find(Request::get('car'));

$car->delete();

Router::redirect('admin.cars');
