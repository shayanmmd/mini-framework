<?php

namespace App\Core;

class Request
{
    private $queryParams;
    private $routeParams;
    private $ip;
    private $path;
    private $httpMethod;
    private $userAgent;

    public function __construct()
    {
        $this->queryParams = $_REQUEST ?? null;
        $this->ip = $_SERVER['REMOTE_ADDR'] ?? null;
        $this->path =  $_REQUEST['path'] ?? null;
        $this->httpMethod = strtolower($_SERVER['REQUEST_METHOD']);
        $this->userAgent =  $_SERVER['HTTP_USER_AGENT'];
    }

    public function getQueryParams()
    {
        return $this->queryParams;
    }

    public function queryParamInput(string $key)
    {
        return $this->queryParams[$key] ?? null;
    }

    public function GetIp()
    {
        return $this->ip;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function GetFullUrl()
    {
        $path = $this->getPath();
        if (is_null($path))
            return null;
        return $_ENV['DOMAIN'] . "/" . $path;
    }

    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    public function getUserAgent()
    {
        return  $this->userAgent;
    }

    public function redirect(string $path = "")
    {
        $url = "location:";

        if (empty($path))
            $url .= $_ENV["DOMAIN"];
        else
            $url .= "/views/" . $path;

        header($url);
        die();
    }

    public function addRouteParam($key, $value)
    {
        $this->routeParams[$key] = $value;
    }

    public function getRouteParam($key)
    {
        return $this->routeParams[$key];
    }

    public function getRouteParams()
    {
        return $this->routeParams;
    }
}
