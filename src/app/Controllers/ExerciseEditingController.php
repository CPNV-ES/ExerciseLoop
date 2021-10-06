<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Questions;
use App\Models\Types;

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

    public function createQuestion($parameters)
    {
        var_dump($parameters);
        Questions::create(['question' => $parameters['form']['field']['label'],'exercise_id' =>$parameters['id'],'type_id' => Types::slug($parameters['form']['field']["value_kind"])]);

        header("Location: /exercise/". $parameters['id'] . "/edit");
        exit();
    }
}
