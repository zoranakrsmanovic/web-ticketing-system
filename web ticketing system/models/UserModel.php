<?php


namespace app\models;


use app\core\DBModel;

class UserModel extends DBModel
{
    public $user_id;
    public $user_name;
    public $email;
    public $password;
    public $confirmPassword;
    public $createdAt;
    public $roleName;

    public function tableName()
    {
        return "users";
    }

    public function attributes(): array
    {
        return [
            'user_id',
            'user_name',
            'email',
            'password'
        ];
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_EMAIL, self::RULE_REQUIRED, self::RULE_EMAIL_UNIQUE],
            'user_name' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function labels(): array
    {
        return [
            "user_name" => "User name",
            "email" => "Email",
            "password" => "Password",
            "confirmPassword" => "Confirm password"
        ];
    }

    public function readAllUserData($email)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "SELECT 	
                        u.user_id,
                        u.email,
                        r.roleName
                FROM users u
                INNER JOIN role_user ru ON u.user_id = ru.user_id
                INNER JOIN roles r ON r.role_id = ru.role_id
                WHERE email ='$email'";

        $dataResult = $db->query($sqlString) or die();

        $result = $dataResult->fetch_assoc();

        return $result;
    }

    public function updateUser(UserModel $model)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "UPDATE users SET `name` = '$model->name' WHERE id='$model->user_id'";

        $db->query($sqlString) or die();

        return true;
    }

    public function userCreate(UserModel $model) {

        $model->create();

        $userModel = new UserModel();

        $user = $userModel->one("email = '$model->email';");
        $userModel->loadData($user);

        $rolesModel = new RolesModel();
        $rolesModel->roleName = "user";
        $role = $rolesModel->one("roleName = '$rolesModel->roleName';");
        $rolesModel->loadData($role);

        $userRolesModel = new UserRolesModel();

        $userRolesModel->role_id = $rolesModel->role_id;
        $userRolesModel->user_id = $userModel->user_id;

        $userRolesModel->create();

        return true;
    }

}