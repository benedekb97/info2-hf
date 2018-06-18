<?php

namespace Auto\Controllers;

use Auto\Controller;

class HomeController extends Controller
{

    public function index()
    {
        return parent::view('index');
    }

    public function cars()
    {
        return parent::view('cars');
    }

    public function mechanics()
    {
        return parent::view('mechanics');
    }

    public function services()
    {
        return parent::view('services');
    }

    public function profile()
    {
        return parent::view('profile');
    }
}