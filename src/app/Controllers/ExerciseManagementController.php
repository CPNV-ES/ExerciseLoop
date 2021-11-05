<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\States;

class ExerciseManagementController extends Controller
{
    public function index()
    {
        $exercisesBuild = Exercises::where('state_id', States::slug('BUILD'))->get();
        $exercisesAnswer = Exercises::where('state_id', States::slug('ANSWER'))->get();
        $exercisesClose = Exercises::where('state_id', States::slug('CLOSE'))->get();

        return $this->render('exercise-management', ['exercisesBuild' => $exercisesBuild,
            'exercisesAnswer' => $exercisesAnswer, 'exercisesClose' => $exercisesClose]);
    }

    public function removeExercise($params)
    {
        $exercise = Exercises::find($params['id']);
        $exercise->delete();

        header("Location: /exercises");
        exit();
    }
}