<?php

namespace App\Service;

use App\Service;

class TestService
{
    public function test()
    {
        $mdoe = new SessionService();
        return $mdoe->test();
    }
}