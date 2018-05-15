<?php

namespace Auto;

use Auto\Models\Car;
use Auto\Models\Service;
use Auto\Models\User;

if(!isset($current_user) || !$current_user->isAdmin()){
    Router::redirect('index');
    die();
}

$type = Request::post('type');
$age = Request::post('age');
$technical_exam_year = Request::post('technical_exam_year');
$owner = User::find(Request::post('owner'));

Car::create($type, $age, $technical_exam_year, $owner);

Router::redirect('admin.cars');