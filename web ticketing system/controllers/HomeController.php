<?php

namespace app\controllers;

use app\core\Controller;

class HomeController extends Controller
{

    public function dashboard(){

        echo $this->view("home", "main", null);
    }

    public function authorise()
    {
        return [
            "admin",
            "user"
        ];
    }
}