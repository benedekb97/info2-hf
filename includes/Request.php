<?php

namespace Auto;

class Request extends Base
{
    protected static $get;
    protected static $post;

    public static function get($var_name)
    {
        return self::$get[$var_name];
    }

    public static function request()
    {
        return [
            'get' => self::$get,
            'post' => self::$post
        ];
    }

    public static function post($var_name)
    {
        return self::$post[$var_name];
    }

    public static function type()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function uri()
    {
        $uri = [];
        foreach (explode('/', $_SERVER['REQUEST_URI']) as $item) {
            $uri[] = $item;
        }

        array_shift($uri);

        return $uri;
    }

    public static function create()
    {
        foreach ($_GET as $key => $item) {
            self::$get[$key] = self::$mysql->real_escape_string($item);
        }

        foreach ($_POST as $key => $item) {
            self::$post[$key] = self::$mysql->real_escape_string($item);
        }
    }

    public static function passGet($key, $value)
    {
        self::$get[$key] = self::$mysql->real_escape_string($value);
    }

    public static function passPost($key, $value)
    {
        self::$post[$key] = self::$mysql->real_escape_string($value);
    }
}