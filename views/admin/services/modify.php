<?php

namespace Auto;

use Auto\Models\Car;
use Auto\Models\Service;
use Auto\Models\User;

if(!isset($current_user) || !$current_user->isAdmin()){
    Router::redirect('admin.services');
    die();
}

$service = Service::find(Request::get('service'));

$service->setCar(Car::find(Request::post('car-'.$service->getId())));
$service->setFixer(User::find(Request::post('fixer-'.$service->getId())));
$service->setCost(Request::post('cost-'.$service->getId()));
$service->setDescription(Request::post('description-'.$service->getId()));

Router::redirect('admin.services');