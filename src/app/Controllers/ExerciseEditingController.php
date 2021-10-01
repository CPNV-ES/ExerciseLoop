<?php

namespace App\Controllers;

use App\Models\Exercises;

class ExerciseEditingController
{
    public function index($parameters)
    {
        $exercise = Exercises::find($parameters['id']);

        if (empty($exercise)) {
            header("Location: /404");
            exit();
        }

        $exerciseLabel = 'Exercise:';
        $exerciseTitle = $exercise->title;

        ob_start();
        require VIEW_ROOT . "/exercise-editing.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }
}
