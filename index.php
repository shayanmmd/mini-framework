<?php
#front controller

use App\Core\Routing\Router;

include_once "Bootstrap/init.php";



$router = new Router($REQUEST);
$router->run();
