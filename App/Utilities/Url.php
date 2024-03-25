<?php

namespace App\Utilities;

class Url
{
    public static function current()
    {
        $requesrUri = $_SERVER['REQUEST_URI'];

        $requesrUri = strtok($requesrUri, '?');

        return $_ENV['DOMAIN'] . $requesrUri;
    }

    public static function route()
    {
        $requesrUri = $_SERVER['REQUEST_URI'];

        $requesrUri = strtok($requesrUri, '?');

        return  $requesrUri;
    }

    public static function fullUrl()
    {
        return  $_ENV['DOMAIN'] . $_SERVER['REQUEST_URI'];
    }
}
