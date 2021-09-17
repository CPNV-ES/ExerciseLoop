<?php

namespace App\Controllers;

class ExerciseEditingController
{
    public function getView()
    {
        $exerciseLabel = 'Exercise:';
        $exerciseTitle = '{{ Exercise title }}';

        ob_start();
        require VIEW_ROOT . "/exercise-editing.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }
}