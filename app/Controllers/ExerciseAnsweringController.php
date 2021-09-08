<?php

namespace App\Controllers;

class ExerciseAnsweringController
{
    public function getView()
    {
        ob_start();
        require VIEW_ROOT . "/exercise-answering.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }
}