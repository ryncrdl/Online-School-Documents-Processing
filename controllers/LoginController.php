<?php

namespace App\Controllers;

use App\Router;
use App\Models\class_model;

class LoginController
{
    public function index(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $router->renderView('404', []);
            return; // Ensure no further code execution
        }

        $router->post('student', []);
    }

    public function student_login(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conn = new class_model();

            // Use filter_input for better security and validation
            $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
            $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

            if (empty($username) || empty($password)) {
                echo json_encode(['status' => 0, 'message' => 'Username and password are required.']);
                return;
            }

            $getStudent = $conn->login_student($username, $password);

            if ($getStudent && $getStudent['count'] > 0) {
                session_start();
                $_SESSION['student_id'] = $getStudent['student_id'];

                // echo json_encode(['status' => 1, 'message' => 'Login successful.']);
                $router->renderView('student/index', []);
            } else {
                // echo json_encode(['status' => 0, 'message' => 'Invalid credentials or inactive account.']);
            }
        } else {
            echo json_encode(['status' => 0, 'message' => 'Invalid request method.']);
        }
    }
}
