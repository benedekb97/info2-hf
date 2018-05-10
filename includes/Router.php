<?php

namespace Auto;


class Router
{
    protected static $routes;

    public static function get($uri, $page, $name = ''){
        self::$routes[] = [
            'uri' => explode('/', $uri),
            'page' => $page,
            'type' => 'GET',
            'name' => $name
        ];
    }

    public static function post($uri, $page, $name = ''){
        self::$routes[] = [
            'uri' => explode('/', $uri),
            'page' => $page,
            'type' => 'POST',
            'name' => $name
        ];
    }

    protected static function needsVar($uri_section){
        if(strlen($uri_section) > 3){
            return $uri_section[0] == '{' && $uri_section[strlen($uri_section)-1] == '}';
        }else{
            return false;
        }
    }

    protected static function getVarName($uri_section){
        $uri_section = trim($uri_section, '{}');

        return $uri_section;
    }

    protected static function check($route, $uri){
        $match_index = 0;

        foreach($route['uri'] as $key => $value){
            if(isset($uri[$key]) && $uri[$key] == ""){
                $match_index = 0;
            }

            if(isset($uri[$key]) && $uri[$key] == $value){
                $match_index++;
            }elseif(!self::needsVar($value)){
                return 0;
            }

            if(isset($uri[$key]) && self::needsVar($value) && !is_numeric($uri[$key])){
                return 0;
            }

            if(isset($uri[$key]) && self::needsVar($value) && is_numeric($uri[$key])){
                $match_index++;
            }
        }

        if(sizeof($route['uri']) != sizeof($uri) && $uri[sizeof($uri)-1] != ''){
            return 0;
        }


        return $match_index;
    }

    public static function route()
    {
        $request_uri = Request::uri();
        $request_type = Request::type();

        $matches = [];

        foreach (self::$routes as $route) {
            $matches[] = [
                'route' => $route,
                'index' => self::check($route, $request_uri) > 0,
                'request' => ($route['type'] == $request_type)
            ];
        }

        $bad_request = false;
        foreach ($matches as $match) {
            if ($match['index'] && $match['request']) {

                foreach ($match['route']['uri'] as $key => $value) {
                    if (self::needsVar($value)) {
                        Request::passGet(self::getVarName($value), $request_uri[$key]);
                    }
                }
                return 'views/' . $match['route']['page'];
            }

            if($match['index'] && !$match['request']){
                $bad_request = true;
            }
        }

        if($bad_request == true){
            return 'views/errors/400.php';
        }

        return 'views/errors/404.php';
    }

    public static function getLink($name, $vars = []){

        foreach(self::$routes as $route){

            if($route['name'] == $name){
                $uri = "";
                foreach($route['uri'] as $uri_section){
                    if(self::needsVar($uri_section)){
                        $uri .= "/".$vars[self::getVarName($uri_section)];
                    }else{
                        $uri .= "/".$uri_section;
                    }

                }

                return $uri;
            }

        }

        return false;

    }

    public static function redirect($route)
    {
        header("Location: ".self::getLink($route));
    }
}