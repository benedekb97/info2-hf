<?php

namespace Auto;

use Auto\Models\Service;
use Auto\Models\User;

$user = User::find(Request::get('user'));
$service = Service::find(Request::get('service'));

if(!isset($current_user)){
    Router::redirect('index.login');
    die();
}

if($current_user == $user || $current_user->isAdmin()){
    $service->delete();

    if(Request::post('return_to') != false){
        Router::redirect(Request::post('return_to'));
        die();
    }
    Router::redirect('user.fixes', ['user' => $user]);
    die();
}else{
    Router::redirect('index');
    die();
}