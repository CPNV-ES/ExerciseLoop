<?php

namespace App\Controllers;

class ExerciseAnsweringController
{
    public function getView()
    {
        $exerciseLabel = 'Exercise: ';
        $exerciseTitle = '{{ Exercise title }}';

        ob_start();
        require VIEW_ROOT . "/exercise-answering.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }
}