<?php

namespace Auto;

use Exception;

require_once "includes/autoload.php";
require_once "includes/init.php";
try{
    include Router::route()->getPath();
}catch(Exception $exception){

}
