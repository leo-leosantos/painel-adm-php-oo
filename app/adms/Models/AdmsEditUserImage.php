<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsCreate;
use App\Adms\Models\helper\AdmsRead;
use App\Adms\Models\helper\AdmsSendEMail;
use App\Adms\Models\helper\AdmsUpdate;
use App\Adms\Models\helper\AdmsValEmail;
use App\Adms\Models\helper\AdmsValEmptyField;
use App\Adms\Models\helper\AdmsValEmailSingle;
use App\Adms\Models\helper\AdmsValPassword;
use App\Adms\Models\helper\AdmsValUserSingle;
use App\Adms\Models\helper\AdmsValUserSingleLogin;

class AdmsEditUserImage
{
    private bool $result;
    private ?array $resultBd = [];
    private ?array $data;
    private ?array $dataImage;
    private ?string $id;
    private ?string $directory;

    private  string $delImage;

    function getResult(): bool
    {
        return $this->result;
    }

    function getResultBd(): ?array
    {
        return $this->resultBd;
    }

    public function editUserImage(?string $id = null): bool
    {
        $this->id = $id;
        $editImage =   new AdmsRead();
        $editImage->fullRead(
            "SELECT id, image
                            FROM adms_users 
                            WHERE id=:id
                            LIMIT :limit",
            "id={$this->id}&limit=1"
        );
        $this->resultBd =  $editImage->getResult();
        if ($this->resultBd) {
            $this->result = true;
            return true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Nenhum user encontrado</p>";
            $this->result = false;
            return false;

        }
    }


    public function update(array $data = null): void
    {

        $this->data = $data;

        $this->dataImage = $this->data['new_image'];

        unset($this->data['new_image']);
        var_dump($this->data);

         $valEmptyField   = new AdmsValEmptyField();
         $valEmptyField->valField($this->data);

         if ($valEmptyField->getResult()) {
            if(!empty($this->dataImage['name'])){
                $this->valInput();
               //$this->result = false;

            }else{
                $_SESSION['msg'] = "<p style='color: #f00'>Error nexessario selcionar imge linha 75 </p>";

                $this->result = false;
            }

         } else {
            $this->result = false;
         }
    }


    private function valInput(): void
    {
        if($this->editUserImage($this->data['id'])){

            $this->upload();
            $this->result = false;
        }else{

            $_SESSION['msg'] = "<p style='color: #f00'>Error Usuario nao encotrando 95 </p>";
            $this->result = false;

        }

       
    }


    private function upload(): void
    {
         $this->directory =   "app/adms/assets/image/users/".$this->data['id']. "/";

         if(  (!file_exists($this->directory))  and (!is_dir($this->directory))){
            mkdir($this->directory, 0755);
         }

         if(move_uploaded_file($this->dataImage['tmp_name'], $this->directory . $this->dataImage['name'])){
            $this->edit();
           // $this->result = false;

         }else{
            $_SESSION['msg'] = "<p style='color: #f00'>Error no upload 118 </p>";
            $this->result = false;
         }

    }
    private function edit(): void
    {
        
        $this->data['image'] = $this->dataImage['name'];

        $this->data['modified'] =  date("Y-m-d H:i:s");
     
        $upUser =   new AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upUser->getResult()) {
            $this->deleteImage();
        } else {
            $_SESSION['msg'] = "ERRROR EDIT IMAGE USER";

            $this->result = false;
        }
    }

    private function deleteImage(): void
    {
        if( ((! empty($this->resultBd[0]['image'])) or ($this->resultBd[0]['image'] != null  ))  and ( $this->resultBd[0]['image'] != $this->dataImage['name']) )  {
            $this->delImage = "app/adms/assets/image/users/".$this->data['id']. "/" . $this->resultBd[0]['image'];

            if(file_exists($this->delImage)){
                unlink($this->delImage);
            }
        }
      
        $_SESSION['msg'] = "User Edit Image sucessfully link 153";
        $this->result = false;
    }
}
