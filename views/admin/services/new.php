<?php

namespace Auto;

use Auto\Models\Car;
use Auto\Models\Service;
use Auto\Models\User;

if(!isset($current_user) || !$current_user->isAdmin()){
    Router::redirect('admin.services');
    die();
}

$car = Car::find(Request::post('car'));
$fixer = User::find(Request::post('fixer'));
$cost = Request::post('cost');
$description = Request::post('description');

Service::create($car, $fixer, $cost, $description);

Router::redirect('admin.services');