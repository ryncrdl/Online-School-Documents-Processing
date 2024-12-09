<?php


use App\Controllers\StudentController;
use App\Router;
use App\controllers\LoginController;

require_once '../vendor/autoload.php';

$router = new Router();

$router->get('/', [LoginController::class, 'index']);
$router->post('/login', [LoginController::class, 'student_login']);


$router->get('/student', fn: [StudentController::class, 'index']);
$router->get('/request-list', fn: [StudentController::class, 'request_list']);
$router->get('/add-request', fn: [StudentController::class, 'add_request']);

// $router->get('/teams', [TeamsController::class, 'index']);
// $router->get('/teams/create', [TeamsController::class, 'create']);
// $router->get('/teams/update', [TeamsController::class, 'update']);

// $router->post('/teams/create', [TeamsController::class, 'create']);
// $router->post('/teams/update', [TeamsController::class, 'update']);
// $router->post('/teams/delete', [TeamsController::class, 'delete']);

$router->resolve();