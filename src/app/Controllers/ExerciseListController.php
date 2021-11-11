<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\States;

class ExerciseListController extends Controller
{
    public function index()
    {
        $exercises = Exercises::where('state_id', States::slug('ANSWER'))->get();

        return $this->render('exercise-list', ['exercises' => $exercises], 
        [
            'description' => 'List of all answerable exercises',
            'keywords' => 'Exercise, List'
        ]);
    }
}
