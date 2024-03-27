<?php

namespace App\MiddleWares;

use App\Contracts\MiddleWare\MiddleWaresInterface;

class checkIpMiddleWare implements MiddleWaresInterface
{
    public function handle()
    {
        global $REQUEST;
        echo "Your ip address is =" . $REQUEST->GetIp() . "<br>";
    }
}
