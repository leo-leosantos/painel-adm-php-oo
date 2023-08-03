<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsRead;
use App\Adms\Models\helper\AdmsUpdate;
use App\Adms\Models\helper\AdmsValEmptyField;
use App\Adms\Models\helper\AdmsValPassword;

class AdmsUpdatePassword
{
    private ?array $data;
    private object $conn;
    private bool $result;
    private string $key;
    private array $resultBd;
    private array $dataSave;

    function getResult(): bool
    {
        return $this->result;
    }


    public function valKey(string $key): bool
    {
        $this->key = $key;

        if (!empty($this->key)) {

            $viewKeyUpPass    = new AdmsRead();

            $viewKeyUpPass->fullRead("SELECT id 
                                        FROM adms_users 
                                        WHERE recover_password=:recover_password 
                                        LIMIT :limit", "recover_password={$this->key}&limit=1");
            $this->resultBd = $viewKeyUpPass->getResult();
            if ($this->resultBd) {
                $this->result = true;

                return true;
            } else {
                $_SESSION['msg'] = "Error: link invalid else  linha 43 validade key";
                $this->result = false;
                return false;

            }
        } else {
            $_SESSION['msg'] = "Error: link invalid confEmail";
            $this->result = false;
        }
    }

    public function editPassword(array $data = null): void
    {
        $this->data = $data;


        $valEmptyField    = new AdmsValEmptyField();
        $valEmptyField->valField($this->data);

        //var_dump($valEmptyField);
        if ($valEmptyField->getResult()) {
             $this->valInput();
        } else {
            $this->result = false;
        }
    }

    private function valInput(): void
    {
         $valPassword =   new AdmsValPassword();
         $valPassword->validatePassword($this->data['password']);

         if($valPassword->getResult()){
            if($this->valKey($this->data['key'])){
                $this->updatePassword();
            }else{
                $this->result = false;

            }
         }else{
            $this->result = false;
         }
    }

    private function updatePassword(): void
    {
        $this->dataSave['recover_password'] = null;
        $this->dataSave['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $this->dataSave['modified'] = date("Y-m-d H:i:s");


        $upPassword = new AdmsUpdate();
        $upPassword->exeUpdate("adms_users", $this->dataSave, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

     

        if($upPassword->getResult()){
            $_SESSION['msg'] = "success: senha atualizada com suceeso linha 102 admsUpdatePassword";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "error: senha não  atualizada linha 105 admsUpdatePassword";
            $this->result = false;
        }
    }
}
