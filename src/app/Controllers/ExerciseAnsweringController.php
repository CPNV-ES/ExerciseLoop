<?php

namespace App\Controllers;

use App\Models\Answers;
use App\Models\Exercises;
use App\Models\Submissions;

class ExerciseAnsweringController extends Controller
{
    /**
     * 
     */
    public function index($params)
    {
        $exercise = Exercises::find($params['id']);

        if (empty($exercise)) {
            header("Location: /404");
            exit();
        }

        return $this->render('exercise-answering', [
            'exerciseLabel' => 'Exercise: ',
            'exerciseTitle' => $exercise->title,
            'exerciseTips' => "If you'd like to come back later to finish, simply submit it with blanks",
            'exercise' => $exercise
        ]);
    }

    /**
     * 
     */
    public function answer($params)
    {
        $exercise = Exercises::find($params['id']);

        if (empty($exercise)) {
            header("Location: /404");
            exit();
        }

        $questions = $exercise->questions();

        do {
            $isUniquePath = true;
            $path = uniqid(rand());
            
            try {
                $submission = Submissions::create(['path' => $path, 'timestamp' => date('Y-m-d H:i:s')]);
            } catch (\PDOException $e) {
                $isUniquePath = false;
            }
        } while (!$isUniquePath);

        $answerIndex = 0;
        foreach ($params['form'] as $answer) {
            Answers::create([
                "answer" => $answer,
                "question_id" => $questions[$answerIndex]->id,
                "submission_id" => $submission->id
            ]);
            $answerIndex++;
        }

        // FastRoute doesn't not implement redirect path yet
        // Redirect to personnel answer editing
        header("Location: /exercise/" . $params['id'] . "/" . $path . "/answer");
    }

    /**
     * 
     */
    public function personalAnswer($params)
    {
        $exercise = Exercises::find($params['id']);

        if (empty($exercise)) {
            header("Location: /404");
            exit();
        }

        $submission = Submissions::where('path', $params['path'])->first();

        return $this->render('exercise-answering', [
            'exerciseLabel' => 'Exercise: ',
            'exerciseTitle' => $exercise->title,
            'exerciseTips' => "Bookmark this page, it's yours. You'll be able to come back later to finish.",
            'exercise' => $exercise,
            'submission' => $submission
        ]);
    }

    public function editPersonalAnswer($params)
    {
        $exercise = Exercises::find($params['id']);

        if (empty($exercise)) {
            header("Location: /404");
            exit();
        }

        $submission = Submissions::where('path', $params['path'])->first();
        $answers = $submission->answers();

        $answerIndex = 0;
        foreach ($params['form'] as $newAnswer) {
            $answers[$answerIndex]->answer = $newAnswer;
            $answers[$answerIndex]->save();

            $answerIndex++;
        }

        return $this->render('exercise-answering', [
            'exerciseLabel' => 'Exercise: ',
            'exerciseTitle' => $exercise->title,
            'exerciseTips' => "Bookmark this page, it's yours. You'll be able to come back later to finish.",
            'exercise' => $exercise,
            'submission' => $submission
        ]);
    }
}
