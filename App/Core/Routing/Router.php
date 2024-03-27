<?php

namespace App\Core\Routing;

use App\Utilities\Url;
use Exception;

class Router
{
    private $request;
    private $routes;
    private $currentRoute;

    const BASE_CONTROLLER = "\App\Controllers\\";


    public function __construct($request)
    {
        $this->request = $request;
        $this->routes = Routes::routes();
        $this->currentRoute = $this->findCurrentRoute() ?? null;
    }

    public function run()
    {
        if (is_null($this->currentRoute) || empty($this->currentRoute)) {
            view('errors.404');
            die();
        }

        if (!in_array($this->request->getHttpMethod(), $this->currentRoute['methods']))
            return;

        $this->redirectTruePath();
    }

    private function findCurrentRoute()
    {
        foreach ($this->routes as $key => $value) {
            $pattern = "/^" . str_replace(['/', '{', '}'], ['\/', '(?<', '>[-%\w]+)'], $value['uri']) . "$/";
            $isMatched = preg_match($pattern, Url::route(),$maches);
            if ($isMatched) {
                foreach ($maches as $key => $match) {
                    if(!is_int($key)){
                        $this->request->addRouteParam($key,$match);
                    }
                }
                return $value;
            }
        }
    }

    private function redirectTruePath()
    {
        $ControllerAndMethod = explode("@", $this->currentRoute['callBack']);

        $controllerClass = self::BASE_CONTROLLER . $ControllerAndMethod[0];
        $methodOfController = $ControllerAndMethod[1];

        if (!class_exists($controllerClass))
            throw new Exception();

        $controllerInstance = new $controllerClass();
        $controllerInstance->{$methodOfController}();
    }

    public function enableMiddleWares()
    {
        $middleWares = $this->currentRoute['middleWares'] ?? null;
        if (is_null($middleWares))
            return;
        foreach ($middleWares as $middleWareClass) {
            $middleWareClassObj = new $middleWareClass;
            $middleWareClassObj->handle();
        }
    }
}
