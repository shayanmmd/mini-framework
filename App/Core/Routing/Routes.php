<?php

namespace App\Core\Routing;

use Exception;

class Routes
{
    private static $routes;
    private static $methods;
    private static $callBack;

    public static function add($uri, $methods, $callBack)
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
            "callBack" => $callBack
        ];
    }

    public static function routes()
    {
        return self::$routes;
    }

    public static function get($uri, $callBack)
    {
        self::add($uri, 'get', $callBack);
    }

    public static function post($uri, $callBack)
    {
        self::add($uri, 'post', $callBack);
    }

    public static function put($uri, $callBack)
    {
        self::add($uri, 'put', $callBack);
    }

    public static function delete($uri, $callBack)
    {
        self::add($uri, 'delete', $callBack);
    }
}
