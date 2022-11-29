<?php
 namespace App\Controllers;

use App\Models\Article;
use App\Templete;
use jcobhams\NewsApi\NewsApi;

class ArticlesController
{
    public function index(): Templete
    {
        $newsapi = new NewsApi($_ENV['API_KEY']);

        $articlesApiRespones = $newsapi->getEverything("NHL");

        $articles = [];
        foreach ($articlesApiRespones->articles as $article) {
            $articles [] = new Article(
                $article->title,
                $article->description,
                $article->url,
                $article->author,
                $article->urlToImage
            );
        }

        return new Templete(
            'articles/index.twig',
            [
                'articles' => $articles
            ]
        );
    }

}