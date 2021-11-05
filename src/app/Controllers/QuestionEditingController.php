<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Questions;
use App\Models\Types;
use App\Models\States;

class QuestionEditingController extends Controller
{
    public function index($params)
    {
        $exercise = Exercises::find($params['id']);
        $question = Questions::find($params['questionId']);

        if (!isset($exercise) || $exercise->state_id != States::slug('BUILD') || !isset($question)) {
            (new ErrorController)->index(Error::NOT_FOUND);
            exit();
        }

        // Generate CSRF Token
        $_SESSION["token"] = bin2hex(random_bytes(32));

        return $this->render('question-editing', [
            'exercise' => $exercise,
            'question' => $question,
            'exerciseLabel' => 'Exercise',
            'exerciseTitle' => $exercise->title,
        ]);
    }

    public function editQuestion($params)
    {
        $questionLabel = $params['post']['field']['label'];
        $questionType = $params['post']['field']['value_kind'];

        $question = Questions::find($params['questionId']);
        $question->question = $questionLabel;
        $question->type_id = Types::slug($questionType);
        $question->save();

        header("Location: /exercise/" . $params['id'] . "/edit");
        exit();
    }
}
