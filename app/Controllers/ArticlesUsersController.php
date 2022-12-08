<?php
namespace App\Controllers;

use App\Services\IndexArticleService;
use App\Templete;

class ArticlesUsersController
{
    public function index(): Templete
    {
        $search = $_GET['search'] ?? "NBA";

        $article = (new IndexArticleService())->execute($search);
        var_dump($_SESSION['userId']);
        return new Templete(
            'logedin/indexUser.twig',
            [
                'articles' => $article->get()
            ]
        );
    }

}