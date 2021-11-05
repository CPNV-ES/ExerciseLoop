<?php

require '../vendor/autoload.php';
require '../config/config.php';

// Controllers
use App\Controllers\HomeController,
    App\Controllers\ExerciseAnsweringController,
    App\Controllers\ExerciseCreationController,
    App\Controllers\ExerciseEditingController,
    App\Controllers\ExerciseListController,
    App\Controllers\ExerciseManagementController,
    App\Controllers\QuestionEditingController;

use App\Controllers\Error,
    App\Controllers\ErrorController;

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
    $router->post('/exercise/{id:\d+}/edit/add-question', [ExerciseEditingController::class, 'createQuestion']);
    $router->post('/exercise/{id:\d+}/edit/remove-question/{questionId:\d+}', [ExerciseEditingController::class, 'removeQuestion']);

    $router->get('/exercise/{id:\d+}/edit/edit-question/{questionId:\d+}', [QuestionEditingController::class, 'index']);
    $router->post('/exercise/{id:\d+}/edit/edit-question/{questionId:\d+}', [QuestionEditingController::class, 'editQuestion']);

    $router->post('/exercise/{id:\d+}/destroy', [ExerciseManagementController::class, 'removeExercise']);
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
        (new ErrorController)->index(Error::NOT_FOUND);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:          // ... 405 Method Not Allowed
        $allowedMethods = $routeInfo[1];
        (new ErrorController)->index(Error::METHOD_NOT_ALLOWED);
        break;
    case FastRoute\Dispatcher::FOUND:
        $controllerClass = $routeInfo[1][0];
        $action = $routeInfo[1][1];
        $parameters = $routeInfo[2];

        if ($httpMethod == 'POST') {
            $parameters['form'] = $_POST;
        }

        try {
            (new $controllerClass)->$action($parameters);
        } catch (PDOException $e) {
            (new ErrorController)->index(Error::DATABASE_ERROR);
        }

        break;
}
