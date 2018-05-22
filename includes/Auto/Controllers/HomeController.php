<?php

namespace Auto\Controllers;

use Auto\Controller;

class HomeController extends Controller
{
    public static function index()
    {
        return parent::view('index');
    }

    public static function cars()
    {
        return parent::view('cars');
    }
}