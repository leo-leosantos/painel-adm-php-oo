<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsCreate;
use App\Adms\Models\helper\AdmsRead;
use App\Adms\Models\helper\AdmsSendEMail;
use App\Adms\Models\helper\AdmsUpdate;
use App\Adms\Models\helper\AdmsValEmail;
use App\Adms\Models\helper\AdmsValEmptyField;
use App\Adms\Models\helper\AdmsValEmailSingle;
use App\Adms\Models\helper\AdmsValPassword;
use App\Adms\Models\helper\AdmsValUserSingle;
use App\Adms\Models\helper\AdmsValUserSingleLogin;

class AdmsEditUserPassword
{
    private bool $result;
    private ?array $resultBd = [];
    private ?array $data;
    private ?array $dataExitVal;
    private ?string $id;

    function getResult(): bool
    {
        return $this->result;
    }

    function getResultBd(): ?array
    {
        return $this->resultBd;
    }

    public function viewUser(?string $id = null): void
    {
        $this->id = $id;
        $viewUser =   new AdmsRead();
        $viewUser->fullRead(
            "SELECT id
                    FROM adms_users 
                    WHERE id=:id
                    LIMIT :limit",
            "id={$this->id}&limit=1"
        );
        $this->resultBd =  $viewUser->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Nenhum user encontrado</p>";
            $this->result = false;
        }
    }


    public function update(array $data = null): void
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
        $valPassword = new AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);


        if ($valPassword->getResult() ) {
            $this->editPass();
        } else {
            $this->result = false;
        }
    }


    private function editPass(): void
    {
        
        $this->data['modified'] =  date("Y-m-d H:i:s");
        $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
     
        $upUser =   new AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upUser->getResult()) {
            $_SESSION['msg'] = "User  Password Edit sucessfully";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "ERRROR EDIT USER Password";

            $this->result = false;
        }
    }
}
