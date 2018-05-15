<?php

namespace Auto;

require_once "includes/autoload.php";
require_once "includes/init.php";

$filename = Router::route();

if((@include $filename) === false){
    include 'views/errors/404.php';
}