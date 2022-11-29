<?php
namespace App\Controllers;

use App\Services\IndexArticleService;
use App\Templete;

class ArticlesController
{
    public function index(): Templete
    {
        $search = $_GET['search'] ?? "NHL";

        $article = (new IndexArticleService())->execute($search);

        return new Templete(
            'articles/index.twig',
            [
                'articles' => $article->get()
            ]
        );
    }

}