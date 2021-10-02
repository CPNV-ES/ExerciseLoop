<?php

namespace App\Controllers;

use App\Models\Answers;
use App\Models\Exercises;
use App\Models\Submissions;

class ExerciseAnsweringController
{
    /**
     * 
     */
    public function index($parameters)
    {
        $exercise = Exercises::find($parameters['id']);

        if (empty($exercise)) {
            header("Location: /404");
            exit();
        }

        $questions = $exercise->questions();

        $exerciseLabel = 'Exercise: ';
        $exerciseTitle = $exercise->title;
        $exerciseTips = "If you'd like to come back later to finish, simply submit it with blanks";

        ob_start();
        require VIEW_ROOT . "/exercise-answering.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }

    /**
     * 
     */
    public function answer($parameters)
    {
        $exercise = Exercises::find($parameters['id']);

        if (empty($exercise)) {
            header("Location: /404");
            exit();
        }

        $questions = $exercise->questions();

        $path = md5(uniqid(rand(), true));
        $submission = Submissions::create(['path' => $path, 'timestamp' => date('Y-m-d H:i:s')]);


        $answerIndex = 0;
        foreach ($parameters['form'] as $answer) {
            Answers::create([
                "answer" => $answer,
                "question_id" => $questions[$answerIndex]->id,
                "submission_id" => $submission->id
            ]);
            $answerIndex++;
        }

        // FastRoute doesn't not implement redirect path yet
        // Redirect to personnel answer editing
        header("Location: /exercise/" . $parameters['id'] . "/" . $path . "/answer");
    }

    /**
     * 
     */
    public function personalAnswer($parameters)
    {
        $exercise = Exercises::find($parameters['id']);

        if (empty($exercise)) {
            header("Location: /404");
            exit();
        }

        $questions = $exercise->questions();
        $submission = Submissions::where('path', $parameters['path'])->first();

        $exerciseLabel = 'Exercise: ';
        $exerciseTitle = $exercise->title;
        $exerciseTips = "Bookmark this page, it's yours. You'll be able to come back later to finish.";

        ob_start();
        require VIEW_ROOT . "/exercise-answering.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }

    public function editPersonalAnswer($parameters)
    {
        $exercise = Exercises::find($parameters['id']);

        if (empty($exercise)) {
            header("Location: /404");
            exit();
        }

        $questions = $exercise->questions();
        $submission = Submissions::where('path', $parameters['path'])->first();

        $answers = $submission->answers();

        $answerIndex = 0;
        foreach ($parameters['form'] as $newAnswer) {
            $answers[$answerIndex]->answer = $newAnswer;
            $answers[$answerIndex]->save();

            $answerIndex++;
        }

        $exerciseLabel = 'Exercise: ';
        $exerciseTitle = $exercise->title;
        $exerciseTips = "Bookmark this page, it's yours. You'll be able to come back later to finish.";

        ob_start();
        require VIEW_ROOT . "/exercise-answering.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }
}
