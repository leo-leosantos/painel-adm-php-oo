<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsConn;
use PDO;
use App\Adms\Models\helper\AdmsCreate;
use App\Adms\Models\helper\AdmsRead;
use App\Adms\Models\helper\AdmsSendEMail;
use App\Adms\Models\helper\AdmsValEmail;
use App\Adms\Models\helper\AdmsValEmptyField;
use App\Adms\Models\helper\AdmsValEmailSingle;
use App\Adms\Models\helper\AdmsValPassword;
use App\Adms\Models\helper\AdmsValUserSingleLogin;

class AdmsConfEmail extends AdmsConn
{
    private ?array $data;
    private object $conn;
    private bool $result;
    private string $key;
    private array $resultBd;

    function getResult()
    {
        return $this->result;
    }


    public function confEmail(string $key): void
    {
        $this->key = $key;

        if (!empty($this->key)) {

            $viewKeyConfEmail    = new AdmsRead();

            $viewKeyConfEmail->fullRead("SELECT id 
                                        FROM adms_users 
                                        WHERE conf_email =:conf_email 
                                        LIMIT :limit", "conf_email={$this->key}&limit=1");
            if ($this->resultBd = $viewKeyConfEmail->getResult()) {
                $this->updateSitUser();

                
            } else {
                $_SESSION['msg'] = "Error: link invalid else confEmail linha 48";
                $this->result = false;
                echo "Error: link invalid";
            }
        } else {
            $_SESSION['msg'] = "Error: link invalid confEmail";
            $this->result = false;
        }
    }

    private function updateSitUser(): void
    {
        $conf_email = null;
        $adms_sits_user_id = 1;

        $query_ativar_user =   "UPDATE adms_users 
                                SET conf_email =:conf_email, adms_sits_user_id =:adms_sits_user_id, modified = now()
                                WHERE id=:id LIMIT 1";
        $active_email = $this->connectDb()->prepare($query_ativar_user);
        $active_email->bindParam(':conf_email', $conf_email);
        $active_email->bindParam(':adms_sits_user_id', $adms_sits_user_id);
        $active_email->bindParam(':id', $this->resultBd[0]['id']);
        $active_email->execute();


        if ($active_email->rowCount()) {
            $_SESSION['msg'] = "link active successfully";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "Error: link invalid updateSitUser";
            $this->result = false;
        }
    }
}
