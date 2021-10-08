<?php

require './vendor/autoload.php';
require './config/config.php';

// Controllers
use App\Controllers\HomeController,
    App\Controllers\ExerciseAnsweringController,
    App\Controllers\ExerciseCreationController,
    App\Controllers\ExerciseEditingController,
    App\Controllers\ExerciseListController,
    App\Controllers\ExerciseManagementController;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
    $router->get('/', [HomeController::class, 'index']);

    $router->get('/exercises/answering', [ExerciseListController::class, 'index']);


    $router->get('/exercise/{id:\d+}/answer', [ExerciseAnsweringController::class, 'index']);
    $router->post('/exercise/{id:\d+}/answer', [ExerciseAnsweringController::class, 'answer']);
    $router->get('/exercise/{id:\d+}/{path:\w+}/answer', [ExerciseAnsweringController::class, 'personalAnswer']);
    $router->post('/exercise/{id:\d+}/{path:\w+}/answer', [ExerciseAnsweringController::class, 'editPersonalAnswer']);
    $router->get('/exercises/new', [ExerciseCreationController::class, 'index']);
    $router->post('/exercises/new', [ExerciseCreationController::class, 'createExercise']);

    $router->get('/exercise/{id:\d+}/edit', [ExerciseEditingController::class, 'index']);
    $router->post('/exercise/{id:\d+}/edit', [ExerciseEditingController::class, 'createQuestion']);
    $router->post('/exercise/{id:\d+}/edit/status/{status:\w+}', [ExerciseEditingController::class, 'changeStatus']);


    $router->get('/exercises', [ExerciseManagementController::class, 'index']);
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
        $controllerClass = $routeInfo[1][0];
        $action = $routeInfo[1][1];
        $parameters = $routeInfo[2];

        if ($httpMethod == 'POST') {
            $parameters['form'] = $_POST;
        }

        (new $controllerClass)->$action($parameters);
        break;
}
