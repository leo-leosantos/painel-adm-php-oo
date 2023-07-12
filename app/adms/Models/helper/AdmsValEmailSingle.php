<?php


namespace App\Adms\Models\helper;

use App\Adms\Models\helper\AdmsRead;


class AdmsValEmailSingle
{
    private string $email;
    private ?bool $edit;
    private ?int $id;
    private bool $result;
    private ?array $resultBd;

    function getResult(): bool
    {
        return $this->result;
    }
    public function validateEmailSingle(string $email, ?bool $edit=null, ?int $id = null ): void
    {
        
            $this->email = $email;
            $this->edit = $edit;
            $this->id = $id;

          $valEmailSingle = new AdmsRead();

          if(($this->edit == true) and (!empty($this->id)))
          {
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email id <>:id 
            LIMIT :limit", "email={$this->email}&id={$this->id}&limit=1");    

          }else{
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email LIMIT :limit", "email={$this->email}&limit=1");    
        }

          $this->resultBd =  $valEmailSingle->getResult();
        if( !$this->resultBd ) {
                $this->result = true;
        }else{
            $_SESSION['msg'] = "Error esse email ja existe";

            $this->result = false;

        }   

     
    }


   
}
