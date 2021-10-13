<?php

namespace App\Controllers;

class ExerciseManagementController extends Controller
{
    public function index()
    {
        return $this->render('exercise-management');
    }
}