<?php


namespace App\Adms\Models;
if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

use App\Adms\Models\helper\AdmsPagination;
use App\Adms\Models\helper\AdmsRead;


class AdmsListUsers
{
    private bool $result;
    private ?array $resultBd;
    private ?int $page;
    private int $limitResult = 3;

    private ?string $resultPg;


    function getResult(): bool
    {
        return $this->result;
    }

    function getResultBd(): ?array
    {
        return $this->resultBd;
    }
    function getResultPg(): ?string
    {
        return $this->resultPg;
    }

    public function listUsers(int $page = null): void
    {
        $this->page =   (int) $page ? $page : 1;
       // var_dump($this->page);      
        $pagination =  new AdmsPagination(URLADM . 'list-users/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result FROM adms_users usr");

         $this->resultPg = $pagination->getResult();
           // var_dump($this->resultPg);

        $listUsers =   new AdmsRead();
        $listUsers->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email , usr.adms_sits_user_id, 
                              sit.name AS name_sit,
                              col.color As color
                              FROM adms_users AS usr
                              INNER JOIN  adms_sists_users AS sit ON sit.id=usr.adms_sits_user_id
                              INNER JOIN  adms_colors AS col ON col.id=sit.adms_color_id
                              ORDER BY usr.id ASC 
                              LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd =  $listUsers->getResult();

        if ($this->resultBd) {
            $this->result = true;

        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Nenhum usuário encontrado</p>";
            $this->result = false;
        }
    }
}
