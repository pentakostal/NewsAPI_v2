<?php

namespace App\Controllers;

use App\Redirect;
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
        if($logInService->execute(
            new LogInServiceRequest(
                $_POST["email"],
                $_POST["password"]
            )
        )){
            return new Redirect("/user");
        }
        return new Redirect("/logFailed");
    }

    public function logOut(): Redirect
    {
        return new Redirect("/");
    }

    public function logFailed(): Templete
    {
        return new Templete('login/loginFailed.twig');
    }
}