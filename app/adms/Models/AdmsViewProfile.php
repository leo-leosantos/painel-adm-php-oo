<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsRead;


class AdmsViewProfile
{
    private bool $result;
    private ?array $resultBd = [];

    function getResult(): bool
    {
        return $this->result;
    }

    function getResultBd(): ?array
    {
        return $this->resultBd;
    }

    public function viewProfile(): void
    {
        $viewUser =   new AdmsRead();
        $viewUser->fullRead(
            "SELECT  name, email, nickname, user, image, created
                            FROM adms_users
                            WHERE id=:id
                            LIMIT :limit",
            "id=".$_SESSION['user_id']."&limit=1"
        );
        $this->resultBd =  $viewUser->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Nenhum perfil encontrado</p>";
            $this->result = false;
        }
    }
}
