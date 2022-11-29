<?php
 namespace App\Controllers;

use App\Templete;

class ArticlesController
{
    public function index(): Templete
    {
        return new Templete(
            'articles/index.twig'
        );
    }

}