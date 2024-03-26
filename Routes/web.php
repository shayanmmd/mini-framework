<?php

use App\Core\Routing\Routes;
use App\MiddleWares\checkIpMiddleWare;

Routes::get('/','HomeController@index',[checkIpMiddleWare::class]);
