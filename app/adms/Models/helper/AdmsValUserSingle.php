<?php


namespace App\Adms\Models\helper;

use App\Adms\Models\helper\AdmsRead;


class AdmsValUserSingle
{
    private string $user;
    private string $email;

    private ?bool $edit;
    private ?int $id;
    private bool $result;
    private ?array $resultBd;

    function getResult(): bool
    {
        return $this->result;
    }
    public function validateUserSingle(string $user, ?bool $edit=null, ?int $id = null ): void
    {
        
            $this->user = $user;
            $this->edit = $edit;
            $this->id = $id;

    
            $valUserSingle = new AdmsRead();

            if(($this->edit == true) and (!empty($this->id)))
            {
              $valUserSingle->fullRead("SELECT id FROM adms_users WHERE (user =:user OR email =:email) 
                  AND id <>:id 
              LIMIT :limit", "user={$this->user}&email={$this->user}&id={$this->id}&limit=1");    
  
            }else{
              $valUserSingle->fullRead("SELECT id FROM adms_users WHERE user =:user LIMIT :limit", "user={$this->user}&limit=1");    
          }
  
            $this->resultBd =  $valUserSingle->getResult();
          if( !$this->resultBd ) {
                  $this->result = true;
          }else{
              $_SESSION['msg'] = "Error esse usuario ja existe";
  
              $this->result = false;
  
          }   
     
    }


   
}
