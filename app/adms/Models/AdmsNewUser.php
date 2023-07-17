<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsCreate;
use App\Adms\Models\helper\AdmsSendEMail;
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
    private string $fromEmail;
    private string $firstName;
    private array $emailData;
    private string $url;

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

        $valUserSingleLogin = new AdmsValUserSingleLogin();
        $valUserSingleLogin->validateUserSingleLogin($this->data['email']);

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
        $this->data['user'] = $this->data['email'];
        $this->data['conf_email'] = password_hash($this->data['password'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);

        $this->data['created'] = date("Y-m-d H:i:s");

        // var_dump($this->data);

        $createUser   =  new AdmsCreate();
        $createUser->exeCreate('adms_users', $this->data);

        if ($createUser->getResult()) {
            // $_SESSION['msg'] = "Add new user successfully";
            // $this->result = true;
            $this->sendEmail();
        } else {
            $_SESSION['msg'] = "Add new user error";

            $this->result = false;
        }
    }

    private function sendEmail(): void
    {
        $this->contentEmailHtml();
        $this->contentEmailText();

        $sendEmail = new  AdmsSendEMail();
        $sendEmail->sendEmail($this->emailData ,1);

        if($sendEmail->getResult())
        {
            $_SESSION['msg'] = "Add new user successfully acesse sua cx para confirmar o email";
            $this->result = true;
        }else{
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "usuario ok, erro no envio do email{$this->fromEmail}";
            $this->result = false;
        }
         
    }


    private function contentEmailHtml() : void
    {
        $name =  explode(" ", $this->data['name']);
        $this->firstName = $name[0];
        $this->emailData['toEmail'] = $this->data['email'];
        $this->emailData['toName'] = $this->data['name'];
        $this->emailData['subject'] = "Confirmar sua conta ";
        $this->url = URLADM . "conf-email/index?key="  .  $this->data['conf_email'];
        $this->emailData['contentHtml'] = "Prezado {$this->firstName}<br><br>";
        $this->emailData['contentHtml'] .= "Obrigado por cadastrar<br><br>";
        $this->emailData['contentHtml'] .= "Click no link abaixo <br><br>";
        $this->emailData['contentHtml'] .= "<a href='{$this->url}'> {$this->url}</a> <br><br>";
        $this->emailData['contentHtml'] .= "Empresa XXX";


    }


    private function contentEmailText() : void
    {
        
        $this->emailData['contentText'] = "Prezado {$this->firstName}\n\n";
        $this->emailData['contentText'] .= "Obrigado por cadastrar\n\n";
        $this->emailData['contentText'] .= "Click no link abaixo \n\n";
        $this->emailData['contentText'] .= $this->url ."\n\n";
        $this->emailData['contentText'] .= "Empresa XXX";

    }
}
