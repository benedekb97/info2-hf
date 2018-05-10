<?php

namespace Auto;

use mysqli;

class Base
{
    protected static $mysql;

    public static function db_connect($host, $username, $password, $db)
    {
        self::$mysql = new mysqli($host, $username, $password, $db);

        self::$mysql->query("SET NAMES utf8");
    }
}