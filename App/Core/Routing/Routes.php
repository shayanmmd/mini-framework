<?php

namespace App\Core\Routing;

use Exception;

class Routes
{
    private static $routes;
    private static $methods;
    private static $callBack;

    public static function add($uri, $methods, $callBack, $middleWares = [])
    {
        if (is_null($uri) || empty($uri))
            throw new Exception();

        if (!is_array($methods))
            $methods = array($methods);

        self::$methods[] = $methods;
        self::$callBack = $callBack;
        self::$routes[] = [
            "uri" => $uri,
            "methods" => $methods,
            "callBack" => $callBack,
            "middleWares" => $middleWares
        ];
    }

    public static function routes()
    {
        return self::$routes;
    }

    public static function get($uri, $callBack, $middleWares = [])
    {
        self::add($uri, 'get', $callBack, $middleWares);
    }

    public static function post($uri, $callBack, $middleWares = [])
    {
        self::add($uri, 'post', $callBack, $middleWares);
    }

    public static function put($uri, $callBack, $middleWares = [])
    {
        self::add($uri, 'put', $callBack, $middleWares);
    }

    public static function delete($uri, $callBack, $middleWares = [])
    {
        self::add($uri, 'delete', $callBack, $middleWares);
    }
}
