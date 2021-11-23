<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Submissions;

class ExerciseResultsController extends Controller
{
    public function index($params)
    {
        $exercise = Exercises::find($params['id']);

        return $this->render('exercise-results', [
            'exerciseLabel' => 'Exercise: ',
            'exerciseTitle' => $exercise->title,
            'exercise' => $exercise,
            define('ANSWER_DOUBLE_LIMIT', 10),
        ],
        [
            'description' => 'Exercise results',
            'keywords' => 'Exercise, Results, Stats'
        ]);
    }
}
