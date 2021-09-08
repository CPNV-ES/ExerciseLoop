<?php

namespace App\Controllers;

class ExerciseCreationController
{
    public function getView()
    {
        ob_start();
        require VIEW_ROOT . "/exercise-creation.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }

}