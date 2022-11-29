<?php

use App\Controllers\ArticlesController;
use App\Models\Article;
use jcobhams\NewsApi\NewsApi;

require_once 'vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', [ArticlesController::class, 'index']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = $handler;

        $respones = (new $controller)->{$method}($vars);

        var_dump($respones);die;

        break;
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$newsapi = new NewsApi($_ENV['API_KEY']);

$articlesApiRespones = $newsapi->getEverything("NHL");

$articles = [];
foreach ($articlesApiRespones->articles as $article) {
    $articles [] = new Article(
        $article->title,
        $article->description,
        $article->url,
        $article->author,
        $article->picture
    );
}

echo "<pre>";
var_dump($articles);