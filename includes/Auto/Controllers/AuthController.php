<?php

namespace Auto\Controllers;


use Auto\Controller;
use Auto\Models\User;
use Auto\Request;
use Auto\Router;

class AuthController extends Controller
{

    public static function login(){

        if(User::authenticate(Request::post('email'), Request::post('password'))){
            $email = Request::post('email');

            $_SESSION['user_id'] = User::findByEmail($email)->getId();

            Router::redirect('index');
            die();
        }else{
            Router::redirect('index.login');
        }
    }

    public static function logout(){
        unset($_SESSION['user_id']);

        Router::redirect('index');
    }
}