<?php

namespace Auto\Controllers;


use Auto\Controller;

class ErrorController extends Controller
{

    public static function badRequest(){
        return parent::view('errors.400');
    }

    public static function notFound(){
        return parent::view('errors.404');
    }
}