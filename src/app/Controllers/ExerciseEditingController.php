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
            (new ErrorController)->index(Error::NOT_FOUND);
            exit();
        }

        return $this->render('exercise-editing', [
            'exerciseLabel' => 'Exercise:',
            'exerciseRoute' => ['route' => '/exercise/' . $exercise->id . '/edit', 'name' => $exercise->title],
            'exercise'      => $exercise
        ], 
        [
            'description' => 'Exercise edit form',
            'keywords'    => 'Exercise, Edition, Form'
        ]);
    }

    public function createQuestion($params)
    {
        Questions::create([
            'question'    => $params['post']['field']['label'],
            'exercise_id' => $params['id'],
            'type_id'     => Types::slug($params['post']['field']["value_kind"])
        ]);

        $this->redirectToExerciseEdition($params['id']);
    }

    public function removeQuestion($params)
    {
        $question = Questions::find($params['questionId']);
        $question->delete();

        $this->redirectToExerciseEdition($params['id']);
    }

    public function changeStatus($params)
    {
        $exercise = Exercises::find($params['id']);
        if (empty($exercise->questions())) {
            $this->redirectToExerciseEdition($params['id']);
        }

        $exercise->state_id = States::slug($params['status']);
        $exercise->save();

        header("Location: /exercises");
        exit();
    }

    private function redirectToExerciseEdition($id)
    {
        header("Location: /exercise/$id/edit");
        exit();
    }
}
