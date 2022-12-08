<?php

namespace App\Controllers;

use App\Services\ChangeDataService;
use App\Services\ChangeDataServiceRequest;
use App\Templete;

class UserDataChange
{
    public function index(): Templete
    {
        return new Templete(
            'logedin/userDataChange.twig',
        );
    }

    public function changeData()
    {
        $cahngeDataService = new ChangeDataService();
        $cahngeDataService->execute(
            new ChangeDataServiceRequest(
                $_POST["passwordConfirmation"],
                $_POST["nameNew"],
                $_POST["emailNew"],
                $_POST["passwordNew"],
                $_POST["pswRepeatNew"]
            )
        );
    }
}