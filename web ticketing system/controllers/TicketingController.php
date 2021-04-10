<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\models\TicketingModel;

class TicketingController extends Controller
{
    /**
     * List of all tickets
     */
    public function home() {
        echo $this->view("ticketing", "main", null);
    }

    public function ticketingJSON()
    {
        $model = new TicketingModel();

        $numberOfRows = $this->request->getOne("numberOfRows");
        $search = $this->request->getOne("search");
        $numberOfPage = $this->request->getOne("numberOfPage");

        $dbData = $model->ticketLoadMore($numberOfPage, $numberOfRows, $search);

        echo json_encode($dbData);
    }


    /**
     * Read one object from table ticket
     */
    public function details() {
        $model = new TicketingModel();

        $model->loadData($this->request->all());

        $model = $model->readOne($model);

        echo $this->view("ticketDetails", "main", $model);
    }

    /**
     * Edit one object from table tickets
     */
    public function edit() {
        $model = new TicketingModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("ticket_id = $model->ticket_id"));

        echo $this->view("ticketEdit", "main", $model);
    }

    public function editProcess()
    {
        $model = new TicketingModel();

        $model->loadData($this->request->all());
        $model->category_id = $_POST['category'];

        if ($model->errors === null) {

            $model->updated_at = date('Y-m-d');
            if ($model->status_id) {
                $model->status_id = 2;
            } else {
                $model->status_id = 1;
            }
            if ($model->priority_id) {
                $model->priority_id = 2;
            } else {
                $model->priority_id = 1;
            }

            if ($model->editTicket($model)) {
                Application::$app->session->setFlash('success', "Edited successfully!");
                Application::$app->response->redirect("/ticketEdit?ticket_id=$model->ticket_id");
            }
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/ticketEdit?ticket_id=$model->ticket_id");
    }

    public function reports()
    {
        echo $this->view("reports", "main", null);
    }

    public function ticketsByCategory()
    {
        $model = new TicketingModel();

        $dbData = $model->ticketByCategory();

        echo json_encode($dbData);
    }

    public function authorise()
    {
        return [
            "admin"
        ];
    }
}