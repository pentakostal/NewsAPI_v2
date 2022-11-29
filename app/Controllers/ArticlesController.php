<?php
 namespace App\Conroller;

class ArticlesController
{
    public function index()
    {
        var_dump("hello from ArticlesController");
    }

    public function create()
    {
        var_dump("create new article");
    }
}