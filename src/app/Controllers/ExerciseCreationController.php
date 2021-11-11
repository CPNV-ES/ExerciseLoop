<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\States;

class ExerciseCreationController extends Controller
{
    public function index()
    {
        // Generate CSRF Token
        $_SESSION["token"] = bin2hex(random_bytes(32));

        return $this->render('exercise-creation', ['exerciseLabel' => 'New exercise'], [
            'description' => 'Exercise creation form',
            'keywords' => 'Exercise, Creation, Build, Form'
        ]);
    }

    public function createExercise($params)
    {
        $title =  $params['post']['title'];

        if (isset($title) && !is_null($title)) {
            $exercise = Exercises::create(['title' => $title, 'state_id' => States::slug('BUILD')]);
            header("Location: /exercise/" . $exercise->id . "/edit");
            exit();
        }
    }
}
