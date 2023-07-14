<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsCreate;
use App\Adms\Models\helper\AdmsValEmail;
use App\Adms\Models\helper\AdmsValEmptyField;
use App\Adms\Models\helper\AdmsValEmailSingle;
use App\Adms\Models\helper\AdmsValPassword;
use App\Adms\Models\helper\AdmsValUserSingleLogin;

class AdmsNewUser
{
    private ?array $data;
    private object $conn;
    private $result;

    function getResult()
    {
        return $this->result;
    }
    // public function create(array $data = null)
    // {
    //     $this->data = $data;
    //     $valEmptyField   = new AdmsValEmptyField();
    //     $valEmptyField->valField($this->data);

    //     if ($valEmptyField->getResult()) {
    //         $this->conn = $this->connectDb();

    //         $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);

    //         $query_new_user = "INSERT INTO adms_users (name, email, user, password, created) 
    //                             VALUES (:name, :email, :user, :password, now())";

    //         $add_new_user = $this->conn->prepare($query_new_user);
    //         $add_new_user->bindParam(":name", $this->data['name'], PDO::PARAM_STR);
    //         $add_new_user->bindParam(":email", $this->data['email'], PDO::PARAM_STR);
    //         $add_new_user->bindParam(":user", $this->data['email'], PDO::PARAM_STR);
    //         $add_new_user->bindParam(":password", $this->data['password'], PDO::PARAM_STR);

    //         $add_new_user->execute();

    //         if ($add_new_user->rowCount()) {
    //             $_SESSION['msg'] = "Add new user successfully";
    //             $this->result = true;
    //         } else {
    //             $_SESSION['msg'] = "Add new user error";
    //             $this->result = false;
    //         }
    //     } else {
    //         $this->result = false;
    //     }
    // }


    public function create(array $data = null)
    {
        $this->data = $data;
        $valEmptyField   = new AdmsValEmptyField();
        $valEmptyField->valField($this->data);

        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else {
            $this->result = false;
        }
    }

    private function valInput(): void
    {
        $valEmail  = new AdmsValEmail();
        $valEmail->validateEmail($this->data['email']);

        $valEmailSingle = new AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email']);

        $valPassword = new AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);

        $valUserSingleLogin= new AdmsValUserSingleLogin();
        $valUserSingleLogin->validateUserSingleLogin($this->data['email']);

        if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valPassword->getResult())
            and ($valUserSingleLogin->getResult())) {
            $this->add();
        } else {
            $this->result = false;
        }
    }


    private function add(): void
    {
        $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $this->data['user'] = $this->data['email'];
        $this->data['created'] = date("Y-m-d H:i:s");

        // var_dump($this->data);

        $createUser   =  new AdmsCreate();
        $createUser->exeCreate('adms_users', $this->data);

        if ($createUser->getResult()) {
            $_SESSION['msg'] = "Add new user successfully";
            $this->result = false;
        } else {
            $_SESSION['msg'] = "Add new user error";

            $this->result = false;
        }
    }
}
