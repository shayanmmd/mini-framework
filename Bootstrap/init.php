<?php

use App\Core\Request;
use Dotenv\Dotenv;

define('BASE_PATH', __DIR__ . "/../");

include_once BASE_PATH . "vendor/autoload.php";

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$REQUEST =  new Request();

include_once BASE_PATH . "Helpers/helper.php";
include_once BASE_PATH . "Routes/web.php";
