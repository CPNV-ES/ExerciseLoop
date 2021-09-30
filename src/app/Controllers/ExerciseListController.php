<?php

namespace App\Controllers;

use App\Models\Exercises;

class ExerciseListController
{
    /**
     * 
     */
    public function index()
    {
        $exercises = Exercises::where('state_id', 2)->get();

        ob_start();
        require VIEW_ROOT . "/exercise-list.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }
}
