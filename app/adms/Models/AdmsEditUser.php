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

class AdmsEditUser
{
    private bool $result;
    private ?array $resultBd = [];
    private ?array $data;
    private ?array $dataExitVal;
    private ?string $id;
    private array $listRegistryAdd;


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
            "SELECT id, name , email, nickname, user, adms_sits_user_id
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
        $this->dataExitVal['nickname'] = $this->data['nickname'];
      

        unset($this->data['nickname']);

        $valEmptyField   = new AdmsValEmptyField();
        $valEmptyField->valField($this->data);

        if ($valEmptyField->getResult()) {
            $this->valInput();
            $this->result = true;

        } else {
            $this->result = false;
        }
    }


    private function valInput(): void
    {
        $valEmail  = new AdmsValEmail();
        $valEmail->validateEmail($this->data['email']);

        $valEmailSingle = new AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email'], true, $this->data['id']);

        $valUserSingle = new AdmsValUserSingle();
        $valUserSingle->validateUserSingle($this->data['user'], true, $this->data['id']);

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
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upUser->getResult()) {
            $_SESSION['msg'] = "User Edit sucessfully";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "ERRROR EDIT USER";

            $this->result = false;
        }
    }
    public function listSelect(): array
    {
        $list = new AdmsRead();

        $list->fullRead("SELECT id id_sit, name name_sit FROM adms_sists_users ORDER BY name ASC");
        $registry['sit'] =   $list->getResult();

        
        $this->listRegistryAdd = ['sit'=> $registry['sit']];

        return $this->listRegistryAdd;
    }

}
