<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsCreate;
use App\Adms\Models\helper\AdmsRead;
use App\Adms\Models\helper\AdmsValEmail;
use App\Adms\Models\helper\AdmsSendEMail;
use App\Adms\Models\helper\AdmsValPassword;
use App\Adms\Models\helper\AdmsValEmptyField;
use App\Adms\Models\helper\AdmsValUserSingle;
use App\Adms\Models\helper\AdmsValEmailSingle;
use App\Adms\Models\helper\AdmsValUserSingleLogin;

class AdmsAddUsers
{
    private ?array $data;
    private object $conn;
    private $result;
    private string $fromEmail;
    private string $firstName;
    private array $emailData;
    private string $url;
    private array $listRegistryAdd;

    function getResult()
    {
        return $this->result;
    }



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

        $valUserSingleLogin = new AdmsValUserSingle();
        $valUserSingleLogin->validateUserSingle($this->data['user']);

        if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valPassword->getResult())
            and ($valUserSingleLogin->getResult())
        ) {
            $this->add();
        } else {
            $this->result = false;
        }
    }


    private function add(): void
    {
        $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $this->data['conf_email'] = password_hash($this->data['password'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
        $this->data['created'] = date("Y-m-d H:i:s");


        $createUser   =  new AdmsCreate();
        $createUser->exeCreate('adms_users', $this->data);

        if ($createUser->getResult()) {
            $_SESSION['msg'] = "Add new user cadastrar novo usuaario";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "Add new user cadastrar novo usuaario ERROROR";

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
