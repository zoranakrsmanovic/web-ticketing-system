<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\models\UserModel;

class UserController extends Controller
{
    public function create()
    {
        $model = new UserModel();

        echo $this->view("userCreate", "main", $model);
    }

    public function userCreateProcess()
    {
        $model = new UserModel();

        $model->loadData($this->request->all());
        $model->createdAt = date('Y-m-d');

        $model->validate();

        if ($model->errors === null){
            if ($model->userCreate($model)) {
                Application::$app->session->setFlash('success', "User created successfully!");
                Application::$app->response->redirect("/userCreate");
                exit;
            }
        }

        Application::$app->session->setFlash('errors', "Fields are not valid!");
        Application::$app->response->redirect("/userCreate");
        exit;
    }

    public function authorise()
    {
        return [
            "admin"
        ];
    }
}