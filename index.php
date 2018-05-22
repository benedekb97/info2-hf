<?php

namespace Auto;

require_once "includes/autoload.php";
require_once "includes/init.php";

include Router::route()->getPath();