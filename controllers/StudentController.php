<?php

namespace App\Controllers;

use App\Router;
use App\Models\class_model;

class StudentController
{
    public function index(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $router->renderView('404', []);
            return; // Ensure no further code execution
        }

        $router->renderView('student/index', []);
    }
    public function request_list(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $router->renderView('404', []);
            return; // Ensure no further code execution
        }

        $router->renderView('student/request-list', []);
    }

    public function add_request(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $router->renderView('404', []);
            return; // Ensure no further code execution
        }

        $router->renderView('student/add-request', []);
    }

}