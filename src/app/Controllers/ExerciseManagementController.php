<?php

namespace App\Controllers;

class ExerciseManagementController
{
    public function index()
    {
        ob_start();
        require VIEW_ROOT . "/exercise-management.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }
}