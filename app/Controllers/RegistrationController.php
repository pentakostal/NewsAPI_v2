<?php

namespace App\Controllers;

use App\Services\RegistrationService;
use App\Services\RegistrationServiceRequest;
use App\Templete;

class RegistrationController
{
    public function showRegistrationForm(): Templete
    {
        return new Templete('registration/registration.twig');
    }

    public function storeRegistrationForm()
    {
        $registerService = new RegistrationService();
        $registerService->execute(
            new RegistrationServiceRequest(
                $_POST["name"],
                $_POST["email"],
                $_POST["password"]
            )
        );
    }
}