<?php

require './vendor/autoload.php';
require './config/config.php';

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {

    $router->get('/', function () {
        require VIEW_ROOT . "/home.php";
    });

    $router->get('/exercises/answering', function () {
        ob_start();
        require VIEW_ROOT . "/exercise-list.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    });

    $router->get('/exercise/{id:\d+}', function () {
        ob_start();
        require VIEW_ROOT . "/exercise-answering.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    });

    $router->addRoute(['GET', 'POST'], '/exercises/new', function () {
        ob_start();
        require VIEW_ROOT . "/exercise-creation.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    });

    $router->get('/exercises', function () {
        ob_start();
        require VIEW_ROOT . "/exercise-management.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    });
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
    case FastRoute\Dispatcher::NOT_FOUND:                   // ... 404 Not Found
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:          // ... 405 Method Not Allowed
        $allowedMethods = $routeInfo[1];
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        print $handler($vars);
        break;
}
