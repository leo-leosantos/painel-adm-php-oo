<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsCreate;
use App\Adms\Models\helper\AdmsDelete;
use App\Adms\Models\helper\AdmsRead;
use App\Adms\Models\helper\AdmsSendEMail;
use App\Adms\Models\helper\AdmsUpdate;
use App\Adms\Models\helper\AdmsValEmail;
use App\Adms\Models\helper\AdmsValEmptyField;
use App\Adms\Models\helper\AdmsValEmailSingle;
use App\Adms\Models\helper\AdmsValPassword;
use App\Adms\Models\helper\AdmsValUserSingle;
use App\Adms\Models\helper\AdmsValUserSingleLogin;

class AdmsDeleteUser
{
    private bool $result;
    private ?array $data;
    private ?array $dataExitVal;
    private ?string $id;
    private array $listRegistryAdd;


    function getResult(): bool
    {
        return $this->result;
    }



    public function deleteUser(?string $id = null): void
    {
         $this->id = (int) $id;
        // var_dump($id);

            $delUser   = new AdmsDelete();
            $delUser->exeDelete("adms_users","WHERE id =:id","id={$this->id}");

          //  var_dump($delUser);

        if ($delUser->getResult()) {
            $_SESSION['msg'] = "<p style='color: green;'>Deletado com uscesso</p>";
            $this->result = true;

        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Nenhum user encontrado</p>";
            $this->result = false;
        }
    }

}
