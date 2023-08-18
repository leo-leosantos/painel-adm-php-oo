<?php


namespace App\Adms\Models\helper;


class AdmsValExtImage
{
    private string $mimeType;
    private bool $result;

    function getResult(): bool
    {
        return $this->result;
    }
    public function validateExtImg(string $mimeType): void
    {
        
         $this->mimeType = $mimeType;
         switch ($this->mimeType){

            case 'image/jpeg': 
                case 'image/pjpeg':
                        $this->result = true;
            break;
            case 'image/png': 
                case 'image/x-png': 
                        $this->result = true;
            break;

        default: 
                    
            $_SESSION['msg'] = "<p style='color: #f00'>Error Image deve ser png pu jpeg linha 21 </p>";
            $this->result = false;

         }
    }
   
}
