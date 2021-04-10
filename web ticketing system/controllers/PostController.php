<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\models\PostModel;

class PostController extends Controller
{
    public function myTickets() {
        echo $this->view("myTickets", "main", null);
    }

    public function postJSON()
    {
        $model = new PostModel();

        $numberOfRows = $this->request->getOne("numberOfRows");
        $search = $this->request->getOne("search");
        $numberOfPage = $this->request->getOne("numberOfPage");

        $dbData = $model->postLoadMore($numberOfPage, $numberOfRows, $search);

        echo json_encode($dbData);
    }

    public function create() {
        $model = new PostModel();

        echo $this->view("ticketCreate", "main", $model);
    }

    public function authorise()
    {
        return [
            "user"
        ];
    }

    public function ticketCreateProcess() {
        $model = new PostModel();
        $user = Application::$app->session->getAuth('user');

        $model->user_id = $user->user_id;

        $model->loadData($this->request->all());
        $model->created_at = date('Y-m-d');
        $model->status_id = 1;

        $model->validate();

        if ($model->errors === null) {
            if ($model->ticketCreate($model)) {
                Application::$app->session->setFlash('success', "Ticket created successfully!");
                Application::$app->response->redirect("/ticketCreate");
                exit;
            }
        }

        Application::$app->session->setFlash('errors', "Fields are not valid!");
        Application::$app->response->redirect("/ticketCreate");
        exit;
    }

    public function details()
    {
        $model = new PostModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("ticket_id = $model->ticket_id"));

        echo $this->view("ticketDetails", "main", $model);
    }
}