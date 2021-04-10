<?php


namespace app\models;


use app\core\DBModel;

class TicketingModel extends DBModel
{
    public $ticket_id;
    public $title;
    public $content;
    public $user_id;
    public $created_at;
    public $updated_at;
    public $status_id;
    public $priority_id;
    public $solution;
    public $category_id;

    public function rules(): array
    {
        return [
            'title' => [self::RULE_REQUIRED],
            'content' => [self::RULE_REQUIRED]
        ];
    }

    /**
     * @return array
     * Read all data from table ticket
     */
    public function readAll() {

        $db = $this->dbConnection->conn();

        $dbData = $db->query("SELECT * FROM tickets;") or die($db->error);
        $resultArray = [];

        while ($result = $dbData->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    public function readOne(TicketingModel $model): TicketingModel {
        $db = $this->dbConnection->conn();
        $dbData = $db->query("SELECT * FROM tickets WHERE ticket_id = '$model->ticket_id'") or die($db->error);

        $result = $dbData->fetch_assoc();

        $model->loadData($result);

        return $model;
    }

    public function ticketLoadMore($numberOfPage, $numberOfRows, $search)
    {
        $db = $this->dbConnection->conn();

        if ($search !== null and $search !== "") {
            $sqlString = "
                select  ticket.ticket_id,
                        ticket.title,
                        ticket.content,                       
                        ticket.user_id,
                        ticket.created_at,
                        ticket.updated_at,
                        ticket.status_id,
                        ticket.priority_id,
                        ticket.solution,
                        ticket.category_id
                from tickets ticket
                where (ticket.title like '%$search%' or ticket.user_id like '%$search%' or ticket.ticket_id like '%$search%') and ticket.status_id = 1
                order by priority_id desc LIMIT $numberOfRows";
        } else {
            $startOn = $numberOfPage * $numberOfRows;
            $sqlString = "
                select  ticket.ticket_id,
                        ticket.title,
                        ticket.content,                       
                        ticket.user_id,
                        ticket.created_at,
                        ticket.updated_at,
                        ticket.status_id,
                        ticket.priority_id,
                        ticket.solution,
                        ticket.category_id
                from tickets ticket
                where (ticket.title like '%$search%' or ticket.user_id like '%$search%' or ticket.ticket_id like '%$search%') and ticket.status_id = 1
                order by priority_id desc LIMIT $startOn, $numberOfRows";
        }

        $dbData = $db->query($sqlString) or die($db->error);

        $resultArray = [];

        while ($result = $dbData->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    public function editTicket(TicketingModel $model)
    {
        $db = $this->dbConnection->conn();


        $sqlString = "UPDATE tickets SET 
                    `updated_at` = '$model->updated_at',
                    `status_id` = '$model->status_id', 
                    `priority_id` = '$model->priority_id', 
                    `solution` = '$model->solution', 
                    `category_id` = '$model->category_id'
                    WHERE `ticket_id` = '$model->ticket_id';";

        $db->query($sqlString) or die();

        return true;
    }

    public function tableName()
    {
        return 'tickets';
    }

    public function attributes(): array
    {
        return [
            'ticket_id',
            'title',
            'content',
            'user_id',
            'created_at',
            'updated_at',
            'status_id',
            'priority_id',
            'solution',
            'category_id'
        ];
    }

    public function labels(): array
    {
        return [
            "title" => "Title",
            "content" => "Content",
            "created_at" => "Date created",
            "updated_at" => "Date updated",
            "status_id" => "Status",
            "priority_id" => "Priority",
            "solution" => "Solution",
            "category_id" => "Category"
        ];
    }

    public function ticketByCategory()
    {
        $db = $this->dbConnection->conn();

        $sqlString = "select categories.`name`, tickets.`category_id`, count(ticket_id) as 'numberOfTickets' FROM `tickets` inner join categories on tickets.category_id = categories.category_id group by `category_id`";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }
}