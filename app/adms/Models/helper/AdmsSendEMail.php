<?php


namespace App\Adms\Models\helper;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Adms\Models\helper\AdmsRead;

class AdmsSendEMail
{
    private array $data;
    private array $dataInfoEmail;
    private string $fromEmail = EMAILADMIN ;
    private int $optionConfEmail;

    private bool $result;
    private ?array $resultDb;

    function getResult(): bool
    {
        return $this->result;
    }
    function getFromEmail(): string
    {
        return $this->fromEmail;
    }
    public function sendEmail(int $optionConfEmail): void
    {
        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // $this->dataInfoEmail['port'] = 587;

        $this->optionConfEmail = $optionConfEmail;
        $this->data['toEmail'] = "lds.leosantos@gmail.com";
        $this->data['toName'] = "Leandro";
        $this->data['subject'] = "Confirmar o email";

        //Content
        $this->data['contentHtml'] = "Olá Leandro </br> Cadastro ok";
        $this->data['contentText'] = "Olá Leandro  Cadastro ok";
        $this->infoPHPMailer();
    }

    private function infoPHPMailer() 
    {
        $confEmail     = new AdmsRead();

        $confEmail->fullRead("SELECT title, name, email, host, username, password, smtpsecure, port
                        FROM adms_confs_email
                        WHERE id =:id LIMIT :limit", "id={$this->optionConfEmail}&limit=1");

   
        $this->resultDb = $confEmail->getResult();
        if ($this->resultDb) {

            $this->dataInfoEmail['host'] = $this->resultDb[0]['host'];
            $this->dataInfoEmail['fromEmail'] = $this->resultDb[0]['email'];
            $this->fromEmail = $this->dataInfoEmail['fromEmail'] ;
            $this->dataInfoEmail['fromName'] = $this->resultDb[0]['name'];
            $this->dataInfoEmail['username'] = $this->resultDb[0]['username'];
            $this->dataInfoEmail['password'] = $this->resultDb[0]['password'];
            $this->dataInfoEmail['smtpsecure'] = $this->resultDb[0]['smtpsecure'];
            $this->dataInfoEmail['port'] = $this->resultDb[0]['port'];
            $this->sendEmailPhpMailer();
        } else {
            $_SESSION['msg'] = " Error credencias ";
            return false;
        }
    }
    private function sendEmailPhpMailer()
    {
        $mail = new PHPMailer(true);
        try {

            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;   //Enable verbose debug output
            $mail->CharSet = 'UTF-8'; //
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $this->dataInfoEmail['host'];                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $this->dataInfoEmail['username'];                     //SMTP username
            $mail->Password   = $this->dataInfoEmail['password'];                               //SMTP password
            $mail->SMTPSecure = $this->dataInfoEmail['smtpsecure'] ;            //Enable implicit TLS encryption
            $mail->Port       =  $this->dataInfoEmail['port'];


            //Recipients
            $mail->setFrom($this->dataInfoEmail['fromEmail'],  $this->dataInfoEmail['fromName']);
            $mail->addAddress($this->data['toEmail'], $this->data['toName']);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->data['subject'];
            $mail->Body    = $this->data['contentHtml'];
            $mail->AltBody = $this->data['contentText'];

            $mail->send();

            $this->result = true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$e->getMessage()}";
            $this->result = false;
        }
    }
}
