<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\models\LoginModel;
use app\models\UserModel;

class AuthController extends Controller
{
    public function login() {
        $model = new LoginModel();

        echo $this->view("login", "auth", $model);
    }

    public function loginProcess() {
        $model = new LoginModel();
        $userModel = new UserModel();

        $model->loadData($this->request->all());

        $model->validate();

        if ($model->errors === null) {
            if ($model->login($model)) {
                $userData = $userModel->readAllUserData($model->email);

                $userModel->loadData($userData);

                Application::$app->session->setAuth('user', $userModel);
                Application::$app->response->redirect("/home");
                exit;
            }
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->session->setFlash('errorUser', "Email does not exists!");
        Application::$app->response->redirect("/login");
    }

    public function logout() {
        if (Application::$app->session->getAuth('user')) {
            Application::$app->session->remove('user');
        }

        Application::$app->response->redirect("/login");
    }

    public function authorise()
    {
        return [
            "Guest"
        ];
    }
}