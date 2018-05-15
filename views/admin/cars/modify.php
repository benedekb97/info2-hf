<?php

namespace Auto;

use Auto\Models\Car;

if(!isset($current_user) || !$current_user->isAdmin()){
    Router::redirect('index.login');
    die();
}

$car = Car::find(Request::get('car'));

$car->setType(Request::post('type_'.$car->getId()));
$car->setTechnicalExamYear(Request::post('technical_exam_year_'.$car->getId()));
$car->setAge(Request::post('age_'.$car->getId()));
$car->setOwner(Request::post('owner_'.$car->getId()));
$car->save();

Router::redirect('admin.cars');