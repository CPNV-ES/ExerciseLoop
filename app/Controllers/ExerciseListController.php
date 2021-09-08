<?php

namespace App\Controllers;

class ExerciseListController
{
    public function getView(){
        ob_start();
        require VIEW_ROOT . "/exercise-list.php";
        $content = ob_get_clean();
        require VIEW_ROOT . "/layout.php";
    }
}