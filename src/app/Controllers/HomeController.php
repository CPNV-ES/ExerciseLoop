<?php

namespace App\Controllers;

class HomeController
{
    public function index($parameters)
    {
        require VIEW_ROOT . "/home.php";
    }
}