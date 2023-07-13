<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsRead;

class AdmsLogin 
{

    private ?array $data;
    private object $conn;
    private $resultDb;
    private $result;


    function getResult()
    {
        return $this->result;
    }
    public function login(array $data = null)
    {
        $this->data = $data;
        $viewUser  =  new  AdmsRead();

        $viewUser->fullRead("SELECT id, name, nickname, email, password, image 
                                FROM adms_users 
                                WHERE user =:user  OR email =:email LIMIT :limit", "user={$this->data['user']}&email={$this->data['email']}&limit=1");
     

        $this->resultDb = $viewUser->getResult();
        if ($this->resultDb) {
            $this->valPassword();
        } else {
            $_SESSION['msg'] = " Error user or password incorrect";
            return false;
        }
    }


    private function valPassword()
    {
        if (password_verify($this->data['password'], $this->resultDb[0]['password'])) {
            $_SESSION['user_id'] = $this->resultDb[0]['id'];
            $_SESSION['user_name'] = $this->resultDb[0]['name'];
            $_SESSION['user_nickname'] = $this->resultDb[0]['nickname'];
            $_SESSION['user_email'] = $this->resultDb[0]['email'];
            $_SESSION['user_image'] = $this->resultDb[0]['image'];

            $this->result = true;
        } else {
            $_SESSION['msg'] = "Error senha ou user not found";
            $this->result = false;
        }
    }
}
