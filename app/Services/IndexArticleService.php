<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Collections\ArticleCollection;
use jcobhams\NewsApi\NewsApi;

class IndexArticleService
{
    public function execute(string $search): ArticleCollection
    {
        $newsapi = new NewsApi($_ENV['API_KEY']);

        $articlesApiRespones = $newsapi->getEverything($search, null, null, "youtube.com",null, null, "en", null, 20, null);

        $articles = new ArticleCollection();
        foreach ($articlesApiRespones->articles as $article) {
            $articles->add(new Article(
                $article->title,
                $article->description,
                $article->url,
                $article->author,
                $article->urlToImage
            ));
        }

        return $articles;
    }
}