<?php

use App\Models\Article;
use jcobhams\NewsApi\NewsApi;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$newsapi = new NewsApi($_ENV['API_KEY']);

$articlesApiRespones = $newsapi->getEverything(
    $q = "NHL",
    $sources = null,
    $domains = null,
    $exclude_domains = "youtube.com",
    $from = null,
    $to = null,
    $language = "en",
    $sort_by = null,
    $page_size = 10,
    $page = null);

$articles = [];
foreach ($articlesApiRespones->articles as $article) {
    $articles [] = new Article(
        $article->author,
        $article->title,
        $article->description,
        $article->url,
        $article->picture
    );
}

echo "<pre>";
var_dump($articles);