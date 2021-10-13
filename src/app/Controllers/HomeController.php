<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        require VIEW_ROOT . "/home.php";
    }
}