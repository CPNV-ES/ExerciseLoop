<?php

require './vendor/autoload.php';
require './config/config.php';

// Controllers
use \App\Controllers\ExerciseAnsweringController;
use \App\Controllers\ExerciseCreationController;
use \App\Controllers\ExerciseEditingController;
use \App\Controllers\ExerciseListController;
use \App\Controllers\ExerciseManagementController;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {

    $router->get('/', function () {
        require VIEW_ROOT . "/home.php";
    });

    $router->get('/exercises/answering', function () {
        require 'app/Controllers/ExerciseListController.php';
        (new ExerciseListController)->getView();
    });

    $router->get('/exercise/{id:\d+}/answer', function () {
        require 'app/Controllers/ExerciseAnsweringController.php';
        (new ExerciseAnsweringController)->getView();
    });

    $router->get('/exercises/new', function () {
        require 'app/Controllers/ExerciseCreationController.php';
        (new ExerciseCreationController)->getView();
    });
    $router->post('/exercises/new', function () {
        require 'app/Controllers/ExerciseCreationController.php';
        (new ExerciseCreationController)->createExercise();
    });

    $router->get('/exercise/{id:\d+}/edit', function () {
        require 'app/Controllers/ExerciseEditingController.php';
        (new ExerciseEditingController)->getView();
    });

    $router->get('/exercises', function () {
        require 'app/Controllers/ExerciseManagementController.php';
        (new ExerciseManagementController)->getView();
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
        require VIEW_ROOT . "/errors/404.php";
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
