<?php


namespace app\models;


use app\core\DBModel;

class RolesModel extends DBModel
{
    public $role_id;
    public $roleName;

    public function tableName()
    {
        return "roles";
    }

    public function attributes(): array
    {
        return [
            'roleName'
        ];
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
    }

    public function labels(): array
    {
        return [
            'roleName' => "Role name"
        ];
    }
}