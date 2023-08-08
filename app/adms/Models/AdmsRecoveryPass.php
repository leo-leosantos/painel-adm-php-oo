<?php


namespace App\Adms\Models;

use PDO;
use App\Adms\Models\helper\AdmsConn;
use App\Adms\Models\helper\AdmsRead;
use App\Adms\Models\helper\AdmsSendEMail;
use App\Adms\Models\helper\AdmsUpdate;
use App\Adms\Models\helper\AdmsValEmptyField;

class AdmsRecoveryPass extends AdmsConn
{
    private ?array $data;
    private object $conn;
    private bool $result;
    private array $dataSave;

    private array $resultBd;
    private string $fromEmail;
    private string $firstName;
    private array $emailData;
    private string $url;

    function getResult(): bool
    {
        return $this->result;
    }


    public function recoveryPassword(array $data = null): void
    {
        $this->data = $data;
        //  var_dump( $this->data   );

        $valEmptyField =  new AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        //  var_dump($valEmptyField->getResult()  );

        if ($valEmptyField->getResult()) {
            $this->valUser();
        } else {
            $this->result = false;
        }
    }

    private function valUser(): void
    {
        $newConfEmail   = new AdmsRead();
        $newConfEmail->fullRead(
            "SELECT id, name, nickname, email
                                 FROM adms_users
                                 WHERE email=:email
                                 LIMIT :limit",
            "email={$this->data['email']}&limit=1"
        );
        // var_dump($newConfEmail);
        $this->resultBd = $newConfEmail->getResult();

        // var_dump(   $this->resultBd = $newConfEmail->getResult());
        $this->resultBd = $newConfEmail->getResult();
        if ($this->resultBd) {
            //   var_dump(   $this->resultBd = $newConfEmail->getResult());
            $this->valConfEmail();
        } else {
            $_SESSION['msg'] = "Error email nao cadastrado link 55";

            $this->result = false;
        }
    }
    private function valConfEmail(): void
    {
        $this->dataSave['recover_password'] =  password_hash(date("Y-m-d H:i:s") . $this->resultBd[0]['id'], PASSWORD_DEFAULT);
        $this->dataSave['modified'] = date("Y-m-d H:i:s");

        //  var_dump($this->dataSave['recover_password']);
        //  var_dump($this->resultBd[0]['id']);
        $updateConfEmail  = new  AdmsUpdate();
        $updateConfEmail->exeUpdate("adms_users", $this->dataSave, "WHERE id=:id", "id={$this->resultBd[0]['id']}");
        // var_dump($updateConfEmail);

        if ($updateConfEmail->getResult()) {

            $this->resultBd[0]['recover_password'] = $this->dataSave['recover_password'];
            $this->sendEmail();
        } else {
            $_SESSION['msg'] = "Error link nao enviado val conf email";
            $this->result = false;
        }
    }

    private function sendEmail(): void
    {
        $sendEmail   = new AdmsSendEMail();
        $this->emailHTML();
        $this->emailText();
        $sendEmail->sendEmail($this->emailData, 2);

        if ($sendEmail->getResult()) {
            $_SESSION['msg'] = "usuario ok,  recuperar senha novo link enviado com succeso  no seu  email: {$this->resultBd[0]['email']}";
            $this->result = true;
        } else {
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "usuario ok, erro no recuperae senha do email{$this->fromEmail}";
            $this->result = false;
        }
    }


    private function emailHTML(): void
    {

        $name =  explode(" ", $this->resultBd[0]['name']);
        $this->firstName = $name[0];
        $this->emailData['toEmail'] = $this->data['email'];
        $this->emailData['toName'] = $name;
        $this->emailData['subject'] = "REcuperar senha ";
        $this->url = URLADM . "update-password/index?key="  .  $this->resultBd[0]['recover_password'];
        $this->emailData['contentHtml'] = "Prezado {$this->firstName}<br><br>";
        $this->emailData['contentHtml'] .= "REcuperar senha<br><br>";
        $this->emailData['contentHtml'] .= "Click no link abaixo <br><br>";
        $this->emailData['contentHtml'] .= "<a href='{$this->url}'> {$this->url}</a> <br><br>";
        $this->emailData['contentHtml'] .= "Empresa XXX";
    }


    private function emailText(): void
    {
        $this->emailData['contentText'] = "Prezado {$this->firstName}\n\n";
        $this->emailData['contentText'] .= "Obrigado por Recuperar senha\n\n";
        $this->emailData['contentText'] .= "Click no link abaixo \n\n";
        $this->emailData['contentText'] .= $this->url . "\n\n";
        $this->emailData['contentText'] .= "Empresa XXX";
    }
}
