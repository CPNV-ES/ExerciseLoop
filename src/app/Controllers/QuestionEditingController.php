<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Questions;
use App\Models\Types;

class QuestionEditingController extends Controller
{
    public function index($params)
    {
        $exercise = Exercises::find($params['id']);
        $question = Questions::find($params['questionId']);

        if (!isset($exercise) || !isset($question)) {
            header("Location: /404");
            exit();
        }

        return $this->render('question-editing', [
            'exercise' => $exercise,
            'question' => $question,
            'exerciseLabel' => 'Exercise',
            'exerciseTitle' => $exercise->title,
        ]);
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
