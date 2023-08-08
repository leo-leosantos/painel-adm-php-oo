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
    private array $dataSave;

    function getResult(): bool
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

                $dados = $this->updateSitUser();
            } else {
                $_SESSION['msg'] = "Error: link invalid else confEmail linha 4869";
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

        $this->dataSave['conf_email'] = null;
        $this->dataSave['adms_sits_user_id'] = 1;
        $this->dataSave['modified'] = date("Y-m-d H:i:s");

        $upConfEmail = new \App\adms\Models\helper\AdmsUpdate();
        $upConfEmail->exeUpdate("adms_users", $this->dataSave, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

        if ($upConfEmail->getResult()) {
            $_SESSION['msg'] = "<p style='color: green;'>E-mail ativado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link inválido!</p>";
            $this->result = false;
        }
    }
}
