<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsRead;


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

    public function viewUser(?string $id = null): void
    {
        $this->id = $id;
        $viewUser =   new AdmsRead();
        $viewUser->fullRead(
            "SELECT usr.id, usr.name AS name_usr, usr.email, usr.nickname, usr.user, usr.image, 
                            usr.created, usr.modified, sit.name AS name_sit, col.color 
                            FROM adms_users AS usr 
                            INNER JOIN  adms_sists_users AS sit ON sit.id=usr.adms_sits_user_id
                            INNER JOIN  adms_colors AS col ON col.id=sit.adms_color_id
                            WHERE usr.id=:id
                            LIMIT :limit",
            "id={$this->id}&limit=1"
        );
        $this->resultBd =  $viewUser->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Nenhum user encontrado</p>";
            $this->result = false;
        }
    }
}
