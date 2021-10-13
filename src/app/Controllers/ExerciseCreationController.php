<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\States;

class ExerciseCreationController
{
    public function index()
    {
        $exerciseLabel = 'New exercise';

        ob_start();
        require VIEW_ROOT . "/exercise-creation.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }

    public function createExercise($parameters)
    {
        $title =  $parameters['form']['title'];

        if (isset($title) && !is_null($title)){
            $exercise = Exercises::create(['title' => $title, 'state_id' => States::slug('BUILD')]);
            header("Location: /exercise/". $exercise->id . "/edit");
            exit();
        }
    }
}