<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsDelete;
use App\Adms\Models\helper\AdmsRead;

class AdmsDeleteUser
{
    private bool $result;
 
    private ?string $id;
    private ?array $resultBd = [];
    private ?string $delDirectory;

    private ?string $delImg;


    function getResult(): bool
    {
        return $this->result;
    }



    public function deleteUser(?string $id = null): void
    {
        $this->id = (int) $id;
        if ($this->viewUser()) {
            $delUser   = new AdmsDelete();
            $delUser->exeDelete("adms_users", "WHERE id =:id", "id={$this->id}");


            if ($delUser->getResult()) {
                $this->deleteImg();
                $_SESSION['msg'] = "<p class='alert-success'>Deletado com uscesso</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert-info'>Nenhum user encontrado link 40</p>";
                $this->result = false;
            }
        } else {
        }
    }

    private function viewUser(): bool
    {
        $viewUser =   new AdmsRead();
        $viewUser->fullRead(
            "SELECT id, image
                    FROM adms_users
                    WHERE id=:id
                    LIMIT :limit",
            "id={$this->id}&limit=1"
        );
        $this->resultBd =  $viewUser->getResult();

        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-info'>Nenhum user encontrado link 62</p>";
            return false;
        }
    }

    private function deleteImg(){
        if( (! empty($this->resultBd[0]['image'])) or ( $this->resultBd[0]['image'] != null) ){
            $this->delDirectory =   "app/adms/assets/image/users/" . $this->resultBd[0]['id'];
            $this->delImg = $this->delDirectory ."/" . $this->resultBd[0]['image']; 

            if(file_exists($this->delImg))
            {
                unlink($this->delImg);
            }

            if(file_exists($this->delDirectory)){
                rmdir($this->delDirectory);
            }
        }
    }
}
