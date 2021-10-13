<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Questions;
use App\Models\Types;
use App\Models\States;

class ExerciseEditingController
{
    public function index($params)
    {
        $exercise = Exercises::find($params['id']);

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

    public function createQuestion($params)
    {
        Questions::create(['question' => $params['form']['field']['label'], 'exercise_id' => $params['id'], 'type_id' => Types::slug($params['form']['field']["value_kind"])]);

        $this->renderExerciseEdition($params['id']);
    }

    public function removeQuestion($params)
    {
        $question = Questions::find($params['questionId']);
        $question->delete();

        $this->renderExerciseEdition($params['id']);
    }

    public function changeStatus($params)
    {
        $exercice = Exercises::find($params['id']);
        $exercice->state_id = States::slug($params['status']);
        $exercice->save();

        header("Location: /exercises");
        exit();
    }

    private function renderExerciseEdition($id)
    {
        header("Location: /exercise/$id/edit");
        exit();
    }
}
