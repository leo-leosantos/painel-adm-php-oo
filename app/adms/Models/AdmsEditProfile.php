<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsRead;
use App\Adms\Models\helper\AdmsUpdate;
use App\Adms\Models\helper\AdmsValEmail;
use App\Adms\Models\helper\AdmsValEmptyField;
use App\Adms\Models\helper\AdmsValUserSingle;
use App\Adms\Models\helper\AdmsValEmailSingle;


class AdmsEditProfile
{
    private bool $result;
    private ?array $resultBd = [];
    private ?array $data;
    private ?array $dataExitVal;

    function getResult(): bool
    {
        return $this->result;
    }

    function getResultBd(): ?array
    {
        return $this->resultBd;
    }

    public function viewProfile(): void
    {
        $viewUser =   new AdmsRead();
        $viewUser->fullRead(
            "SELECT id, name, email, nickname, user
                            FROM adms_users
                            WHERE id=:id
                            LIMIT :limit",
            "id=".$_SESSION['user_id']."&limit=1"
        );
        $this->resultBd =  $viewUser->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Nenhum perfil encontrado</p>";
            $this->result = false;
        }
    }

    public function update(array $data = null): void
    {

        $this->data = $data;

        $this->dataExitVal['nickname'] = $this->data['nickname'];
        unset($this->data['nickname']);


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
        $valEmailSingle->validateEmailSingle($this->data['email'], true, $_SESSION['user_id']);

        $valUserSingle = new AdmsValUserSingle();
        $valUserSingle->validateUserSingle($this->data['user'], true, $_SESSION['user_id']);

        if ($valEmail->getResult() and $valEmailSingle->getResult() and $valUserSingle->getResult()) {
           $this->edit();
        } else {
            $this->result = false;
        }
    }

    
    private function edit(): void
    {
        
        $this->data['modified'] =  date("Y-m-d H:i:s");
        $this->data['nickname'] = $this->dataExitVal['nickname'];
     
        $upUser =   new AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id=" . $_SESSION['user_id']);

        if ($upUser->getResult()) {
            $_SESSION['user_name'] = $this->data['name'];
            $_SESSION['user_nickname'] = $this->data['nickname'];
            $_SESSION['user_email'] = $this->data['email'];
            $_SESSION['msg'] = "PROFILE Edit sucessfully";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "ERROR EDIT USER PROFILE";

            $this->result = false;
        }
    }
}
