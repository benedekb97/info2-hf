<?php

namespace Auto;

use Auto\Models\Service;

if(!isset($current_user) || !$current_user->isAdmin()){
    Router::redirect('index');
    die();
}

$service = Service::find(Request::get('service'));

$service->delete();

Router::redirect('admin.services');
