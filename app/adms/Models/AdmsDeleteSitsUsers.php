<?php

namespace App\adms\Models;
use App\Adms\Models\helper\AdmsRead;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Apagar situação no banco de dados
 *
 * @author Celke
 */
class AdmsDeleteSitsUsers
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var int|string|null $id Recebe o id do registro */
    private ?int $id;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private ?array $resultBd;

   

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    public function deleteSitUser(int $id): void
    {
        $this->id = (int) $id;

        if( ($this->viewSitUser()) and ($this->checkStatusUsed() )){
            $deleteUser = new \App\adms\Models\helper\AdmsDelete();
            $deleteUser->exeDelete("adms_sists_users", "WHERE id =:id", "id={$this->id}");
    
            var_dump($deleteUser);

             if ($deleteUser->getResult()) {
                 $_SESSION['msg'] = "<p style='color: green;'>Situação apagada com sucesso!</p>";
                 $this->result = true;
             } else {
                 $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Situação não apagada com sucesso!</p>";
                 $this->result = false;
             }
          }
          else{
             $this->result = false;
          }
        
    }

    private function viewSitUser(): bool
    {

        $viewSitUser = new \App\adms\Models\helper\AdmsRead();
        $viewSitUser->fullRead(
            "SELECT id
                            FROM adms_sists_users                           
                            WHERE id=:id
                            LIMIT :limit",
            "id={$this->id}&limit=1"
        );

        $this->resultBd = $viewSitUser->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Usuário não encontrado!</p>";
            return false;
        }
    }


    private function checkStatusUsed(): bool
    {
        $viewUserAdd  = new AdmsRead();
        $viewUserAdd->fullRead("SELECT id FROM adms_users 
        WHERE  adms_sits_user_id =:adms_sits_user_id 
        LIMIT :limit", "adms_sits_user_id={$this->id}&limit=1");
            var_dump($viewUserAdd->getResult());

        if($viewUserAdd->getResult()){
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Situação em uso, nao pode ser apagada!</p>";
            return false;
        }else{
            $_SESSION['msg'] = "<p style='color: green;'>Situação apagada com sucesso!</p>";

            return true;
         }
    }
}
