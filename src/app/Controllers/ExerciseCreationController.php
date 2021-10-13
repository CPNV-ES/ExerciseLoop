<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\States;

class ExerciseCreationController extends Controller
{
    public function index()
    {
        return $this->render('exercise-creation', ['exerciseLabel' => 'New exercise']);
    }

    public function createExercise($params)
    {
        $title =  $params['form']['title'];

        if (isset($title) && !is_null($title)){
            $exercise = Exercises::create(['title' => $title, 'state_id' => States::slug('BUILD')]);
            header("Location: /exercise/". $exercise->id . "/edit");
            exit();
        }
    }
}