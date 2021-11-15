<?php

namespace App\Controllers;

use PDOException;
use App\Models\Answers;
use App\Models\Exercises;
use App\Models\Submissions;
use App\Models\States;

class ExerciseAnsweringController extends Controller
{
    public function index($params)
    {
        $exercise = Exercises::find($params['id']);
        $this->checkExerciseValidity($exercise);

        return $this->render('exercise-answering', [
            'exerciseLabel' => 'Exercise: ',
            'exerciseTitle' => $exercise->title,
            'exerciseTips' => "If you'd like to come back later to finish, simply submit it with blanks",
            'exercise' => $exercise
        ],
        [
            'description' => 'Exercise response form',
            'keywords' => 'Exercise, Answer, Response, Form'
        ]);
    }

    public function answer($params)
    {
        $exercise = Exercises::find($params['id']);
        $this->checkExerciseValidity($exercise);

        do {
            $isUniquePath = true;
            $path = uniqid(rand());

            try {
                $submission = Submissions::create(['path' => $path, 'timestamp' => date('Y-m-d H:i:s')]);
            } catch (PDOException $e) {
                $isUniquePath = false;
            }
        } while (!$isUniquePath);

        foreach ($params['post']['answers'] as $key => $answer) {
            Answers::create([
                "answer" => $answer,
                "question_id" => $key,
                "submission_id" => $submission->id
            ]);
        }

        // FastRoute doesn't not implement redirect path yet
        // Redirect to personnel answer editing
        header("Location: /exercise/" . $params['id'] . "/" . $path . "/answer");
        exit();
    }

    public function personalAnswer($params)
    {
        $exercise = Exercises::find($params['id']);
        $this->checkExerciseValidity($exercise);

        $submission = Submissions::where('path', $params['path'])->first();

        return $this->render('exercise-answering', [
            'exerciseLabel' => 'Exercise: ',
            'exerciseTitle' => $exercise->title,
            'exerciseTips' => "Bookmark this page, it's yours. You'll be able to come back later to finish.",
            'exercise' => $exercise,
            'submission' => $submission
        ],
        [
            'description' => 'Exercise response form',
            'keywords' => 'Exercise, Answer, Response, Form'
        ]);
    }

    public function editPersonalAnswer($params)
    {
        $exercise = Exercises::find($params['id']);
        $this->checkExerciseValidity($exercise);

        $submission = Submissions::where('path', $params['path'])->first();

        foreach ($params['post']['answers'] as $key => $newAnswer) {
            $answer = $submission->answer($key);
            $answer->answer = $newAnswer;
            $answer->save();
        }

        return $this->render('exercise-answering', [
            'exerciseLabel' => 'Exercise: ',
            'exerciseTitle' => $exercise->title,
            'exerciseTips' => "Bookmark this page, it's yours. You'll be able to come back later to finish.",
            'exercise' => $exercise,
            'submission' => $submission
        ],
        [
            'description' => 'Exercise response form',
            'keywords' => 'Exercise, Answer, Response, Form'
        ]);
    }

    private function checkExerciseValidity($exercise)
    {
        if (empty($exercise) || $exercise->state_id != States::slug('ANSWER')) {
            (new ErrorController)->index(Error::NOT_FOUND);
            exit();
        }
    }
}
