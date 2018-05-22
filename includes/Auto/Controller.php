<?php

namespace Auto;


class Controller
{

    protected static function view($view_name){
        return new View($view_name);
    }

}