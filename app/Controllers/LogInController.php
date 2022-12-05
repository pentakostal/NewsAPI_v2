<?php

namespace App\Controllers;

use App\Templete;

class LogInController
{
    public function logIn(): Templete
    {
        return new Templete('login/login.twig');
    }

    public function logToSystem()
    {

    }
}