<?php


namespace app\controllers;


use app\core\Controller;

class AccessController extends Controller
{

    public function authorise()
    {
        return [
            "admin",
            "user"
        ];
    }

    public function accessDenied() {
        echo $this->view("accessDenied", "auth", null);
    }
}