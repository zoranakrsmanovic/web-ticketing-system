<?php


namespace app\models;


use app\core\DBModel;

class UserRolesModel extends DBModel
{
    // public $id;
    public $role_id;
    public $user_id;


    public function tableName()
    {
        return "role_user";
    }

    public function attributes(): array
    {
        return [
            'role_id',
            'user_id'
        ];
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
    }

    public function labels(): array
    {
        // TODO: Implement labels() method.
    }
}