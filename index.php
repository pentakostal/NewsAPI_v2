<?php

require_once 'vendor/autoload.php';

session_start();

use App\Controllers\ArticlesController;
use App\Controllers\ArticlesUsersController;
use App\Controllers\LogInController;
use App\Controllers\RegistrationController;
use App\Controllers\SuccessfulRegistration;
use App\Controllers\UserDataChange;
use App\Redirect;

//api key setup
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


//Router
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', [ArticlesController::class, 'index']);
    $route->addRoute('GET', '/registration', [RegistrationController::class, 'showRegistrationForm']);
    $route->addRoute('POST', '/registration', [RegistrationController::class, 'storeRegistrationForm']);
    $route->addRoute('GET', '/login', [LogInController::class, 'logIn']);
    $route->addRoute('POST', '/login', [LogInController::class, 'logToSystem']);
    $route->addRoute('GET', '/logFailed', [LogInController::class, 'logFailed']);
    $route->addRoute('GET', '/user', [ArticlesUsersController::class, 'index']);
    $route->addRoute('GET', '/logout', [LogInController::class, 'logOut']);
    $route->addRoute('GET', '/userDataChange', [UserDataChange::class, 'index']);
    $route->addRoute('POST', '/successfulRegistration', [RegistrationController::class, 'successfulRegistration']);
    $route->addRoute('POST', '/userDataChange', [UserDataChange::class, 'changeData']);
});

$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader);



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

        if ($respones instanceof \App\Templete) {
            echo $twig->render($respones->getPath(), $respones->getParams());
        }

        if ($respones instanceof Redirect) {
            header('Location: ' . $respones->getUrl());
        }

        break;
}
