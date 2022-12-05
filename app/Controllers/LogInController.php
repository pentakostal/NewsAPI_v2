<?php

namespace App\Controllers;

use App\Services\LogInService;
use App\Services\LogInServiceRequest;
use App\Templete;

class LogInController
{
    public function logIn(): Templete
    {
        return new Templete('login/login.twig');
    }

    public function logToSystem()
    {
        $logInService = new LogInService();
        $logInService->execute(
            new LogInServiceRequest(
                $_POST["email"],
                $_POST["password"]
            )
        );
    }
}