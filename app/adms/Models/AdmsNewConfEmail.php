<?php


namespace App\Adms\Models;

use PDO;
use App\Adms\Models\helper\AdmsConn;
use App\Adms\Models\helper\AdmsRead;
use App\Adms\Models\helper\AdmsSendEMail;

class AdmsNewConfEmail extends AdmsConn
{
    private ?array $data;
    private object $conn;
    private bool $result;
    private array $resultBd;
    private string $fromEmail;
    private string $firstName;
    private array $emailData;
    private string $url;

    function getResult():bool
    {
        return $this->result;
    }


    public function newConfEmail(array $data = null): void
    {
        $this->data = $data;
           $newConfEmail   = new AdmsRead();
           $newConfEmail->fullRead("SELECT id, name, email, conf_email
                                    FROM adms_users
                                    WHERE email =:email LIMIT :limit", "email={$this->data['email']}&limit=1");

        $this->resultBd = $newConfEmail->getResult();
        if($this->resultBd){
            $this->valConfEmail();
        }else{
            $_SESSION['msg'] = "Error email nao cadastrado";

            $this->result = false;
        }
    }

    private function valConfEmail(): void
    {
        if((empty($this->resultBd[0]['conf_email'])) or($this->resultBd[0]['conf_email']==null)){
                    $confEmail =    password_hash(date("Y-m-d H:i:s") . $this->resultBd[0]['id'], PASSWORD_DEFAULT);
            
                 $query_activate_user  = "UPDATE adms_users 
                            SET conf_email =:conf_email, modified = now() 
                            WHERE id =:id
                            LIMIT :limit";

                $activate_user =   $this->connectDb()->prepare($query_activate_user);
                $activate_user->bindParam(':conf_email', $confEmail);
                $activate_user->bindParam(':id', $this->resultBd[0]['id']);
                $activate_user->bindValue(':limit', 1, PDO::PARAM_INT);
                $activate_user->execute();


                if($activate_user->rowCount()){
                    $this->resultBd[0]['conf_email'] = $confEmail;
                    $this->sendEmail();
                }else{
                    $_SESSION['msg'] = "Error link nao enviado";

                    $this->result = false;
                }

        }else{

            $this->sendEmail();

        }
    }

    private function sendEmail(): void
    {
            $sendEmail   = new AdmsSendEMail();
            $this->emailHTML();
            $this->emailText();
            $sendEmail->sendEmail($this->emailData,2);

            if($sendEmail->getResult()){
                $_SESSION['msg'] = "usuario ok,  novo link enviado com succeso  no seu  email: {$this->resultBd[0]['email']}";
                $this->result = true;

            }else{
                $this->fromEmail = $sendEmail->getFromEmail();
                $_SESSION['msg'] = "usuario ok, erro no envio do email{$this->fromEmail}";
                $this->result = false;
            }
    }   

 

    
    private function emailHTML() : void
    {

        $name =  explode(" ", $this->resultBd[0]['name']);
        $this->firstName = $name[0];
        $this->emailData['toEmail'] = $this->data['email'];
        $this->emailData['toName'] = $name;
        $this->emailData['subject'] = "Confirmar sua conta ";
        $this->url = URLADM . "conf-email/index?key="  .  $this->resultBd[0]['conf_email'];
        $this->emailData['contentHtml'] = "Prezado {$this->firstName}<br><br>";
        $this->emailData['contentHtml'] .= "Novo  link  para se cadastrar<br><br>";
        $this->emailData['contentHtml'] .= "Click no link abaixo <br><br>";
        $this->emailData['contentHtml'] .= "<a href='{$this->url}'> {$this->url}</a> <br><br>";
        $this->emailData['contentHtml'] .= "Empresa XXX";


    }


    private function emailText() : void
    {
        
        $this->emailData['contentText'] = "Prezado {$this->firstName}\n\n";
        $this->emailData['contentText'] .= "Obrigado por cadastrar\n\n";
        $this->emailData['contentText'] .= "Click no link abaixo \n\n";
        $this->emailData['contentText'] .= $this->url ."\n\n";
        $this->emailData['contentText'] .= "Empresa XXX";

    }
}
