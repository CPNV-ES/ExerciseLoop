<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Questions;
use App\Models\Submissions;

class ExerciseResultsController extends Controller
{
    public function index($params)
    {
        $exercise = Exercises::find($params['id']);

        return $this->render(
            'exercise-results',
            [
                'exerciseLabel' => 'Exercise: ',
                'exerciseRoute' => ['route' => '/exercise/' . $exercise->id . '/results', 'name' => $exercise->title],
                'exercise' => $exercise,
                define('ANSWER_DOUBLE_LIMIT', 10),
            ],
            [
                'description' => 'Exercise results',
                'keywords' => 'Exercise, Results, Stats'
            ]
        );
    }

    public function focusOnQuestion($params)
    {
        $exercise = Exercises::find($params['id']);
        $question = Questions::find($params['questionId']);
       

        return $this->render(
            'exercise-results-question',
            [
                'exerciseLabel' => 'Exercise: ',
                'exerciseRoute' => ['route' => '/exercise/' . $exercise->id . '/results', 'name' => $exercise->title],
                'exercise' => $exercise,
                'question' => $question,
            ],
            [
                'description' => 'Exercise results focus on question',
                'keywords' => 'Exercise, Results, Stats, Question'
            ]
        );
    }

    public function focusOnSubmission($params)
    {
        $exercise = Exercises::find($params['id']);
        $submission = Submissions::find($params['submissionId']);

        return $this->render(
            'exercise-results-submission',
            [
                'exerciseLabel' => 'Exercise: ',
                'exerciseRoute' => ['route' => '/exercise/' . $exercise->id . '/results', 'name' => $exercise->title],
                'exercise' => $exercise,
                'submission' => $submission,
            ],
            [
                'description' => 'Exercise results focus on submission',
                'keywords' => 'Exercise, Results, Stats, Submission'
            ]
        );
    }
}
