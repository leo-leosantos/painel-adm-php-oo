<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsCreate;
use App\Adms\Models\helper\AdmsRead;
use App\Adms\Models\helper\AdmsSendEMail;
use App\Adms\Models\helper\AdmsValEmail;
use App\Adms\Models\helper\AdmsValEmptyField;
use App\Adms\Models\helper\AdmsValEmailSingle;
use App\Adms\Models\helper\AdmsValPassword;
use App\Adms\Models\helper\AdmsValUserSingleLogin;

class AdmsViewUser
{
    private bool $result;
    private ?array $resultBd = [];
    private ?string $id;

    function getResult(): bool
    {
        return $this->result;
    }

    function getResultBd(): ?array
    {
        return $this->resultBd;
    }

    public function viewUser( ?string $id = null): void
    {
        $this->id = $id;

       // var_dump($this->id);
        $viewUser =   new AdmsRead();
        $viewUser->fullRead("SELECT id, name, email, nickname, user, image, created, modified
                        FROM adms_users 
                        WHERE id=:id
                        LIMIT :limit", "id={$this->id}&limit=1");


        $this->resultBd =  $viewUser->getResult();
        // var_dump($this->resultBd);

        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Nenhum user encontrado</p>";
            $this->result = false;
        }
    }
}
