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
        foreach ($this->routes as $key => $value)
            if (Url::route() === $value['uri'])
                return $value;
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
}
