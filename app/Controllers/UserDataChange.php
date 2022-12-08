<?php

namespace App\Controllers;

use App\Templete;

class UserDataChange
{
    public function index(): Templete
    {
        return new Templete(
            'logedin/userDataChange.twig',
        );
    }
}