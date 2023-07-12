<?php


namespace App\Adms\Models\helper;


class AdmsValEmail
{
    private string $email;
    private bool $result;

    function getResult(): bool
    {
        return $this->result;
    }
    public function validateEmail(string $email): void
    {
        
         $this->email = $email;
            if( filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $this->result = true;
            }else{
                $_SESSION['msg'] =  '<p>Error:  Email invalido</p>';
                $this->result = false;

            }   

     
    }


   
}
