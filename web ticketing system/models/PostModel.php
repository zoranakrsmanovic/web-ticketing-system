<?php


namespace app\models;


use app\core\Application;
use app\core\DBModel;

class PostModel extends DBModel
{
    public $user_id;
    public $title;
    public $content;
    public $created_at;
    public $ticket_id;
    public $status_id;
    public $solution;

    public function tableName()
    {
        return "tickets";
    }

    public function attributes(): array
    {
        return [
            'ticket_id',
            'user_id',
            'title',
            'content',
            'status_id'
        ];
    }

    public function rules(): array
    {
        return [
            'title' => [self::RULE_REQUIRED],
            'content' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            "title" => "Title",
            "content" => "Content"
        ];
    }

    public function ticketCreate(PostModel $model) {
        $model->create();

        return true;
    }

    public function postLoadMore($numberOfPage, $numberOfRows)
    {
        $db = $this->dbConnection->conn();
        $user = Application::$app->session->getAuth('user');
        $id = $user->user_id;

            $startOn = $numberOfPage * $numberOfRows;
            $sqlString = "
                select  post.ticket_id,
                        post.title,
                        post.content,                        
                        post.created_at,
                        post.updated_at,
                        post.status_id,
                        post.priority_id,
                        post.solution,
                        post.category_id
                from tickets post
                where post.user_id like '%$id%' LIMIT $startOn, $numberOfRows";

        $dbData = $db->query($sqlString) or die($db->error);

        $resultArray = [];

        while ($result = $dbData->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }
}