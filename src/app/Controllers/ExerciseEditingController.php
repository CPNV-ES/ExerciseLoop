<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Questions;
use App\Models\Types;
use App\Models\States;

class ExerciseEditingController extends Controller
{
    public function index($params)
    {
        $exercise = Exercises::find($params['id']);

        if (!isset($exercise) || $exercise->state_id != States::slug('BUILD')) {
            header("Location: /404");
            exit();
        }

        return $this->render('exercise-editing', [
            'exerciseLabel' => 'Exercise:',
            'exerciseTitle' => $exercise->title,
            'exercise' => $exercise
        ]);
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
