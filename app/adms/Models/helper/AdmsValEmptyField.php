<?php


namespace App\Adms\Models\helper;


class AdmsValEmptyField 
{
    private ?array $data;
    private bool $result;

    function getResult(): bool
    {
        return $this->result;
    }
    public function valField(array $data = null)
    {
        
        $this->data =  $data;
        
        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);

        if(in_array('',$this->data )){
            $_SESSION['msg'] =  "<strong> Error favor precnher todos os campos </strong>";
            $this->result = false;

        }else{
            $this->result = true;
        }

     
    }


   
}
