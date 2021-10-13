<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Questions;
use App\Models\Types;

class QuestionEditingController
{
    public function index($params)
    {
        $exercise = Exercises::find($params['id']);
        $question = Questions::find($params['questionId']);

        $exerciseLabel = 'Exercise';
        $exerciseTitle = $exercise->title;

        ob_start();
        require VIEW_ROOT . "/question-editing.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }

    public function editQuestion($params)
    {
        $questionLabel = $params['form']['field']['label'];
        $questionType = $params['form']['field']['value_kind'];

        $question = Questions::find($params['questionId']);
        $question->question = $questionLabel;
        $question->type_id = Types::slug($questionType);
        $question->save();

        header("Location: /exercise/" . $params['id'] . "/edit");
        exit();
    }
}
