<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsCreate;
use App\Adms\Models\helper\AdmsRead;
use App\Adms\Models\helper\AdmsSendEMail;
use App\Adms\Models\helper\AdmsSlug;
use App\Adms\Models\helper\AdmsUpdate;
use App\Adms\Models\helper\AdmsUpload;
use App\Adms\Models\helper\AdmsValEmail;
use App\Adms\Models\helper\AdmsValEmptyField;
use App\Adms\Models\helper\AdmsValEmailSingle;
use App\Adms\Models\helper\AdmsValExtImage;
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
    private  string $nameImg;

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

        $valEmptyField   = new AdmsValEmptyField();
        $valEmptyField->valField($this->data);

        if ($valEmptyField->getResult()) {
            if (!empty($this->dataImage['name'])) {
                $this->valInput();
                //$this->result = false;

            } else {
                $_SESSION['msg'] = "<p style='color: #f00'>Error nexessario selcionar imge linha 75 </p>";

                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }


    private function valInput(): void
    {

        $valExtImg  = new AdmsValExtImage();
        $valExtImg->validateExtImg($this->dataImage['type']);
        if (($this->editUserImage($this->data['id'])) and ($valExtImg->getResult())) {
            $this->result = false;

            $this->upload();
        } else {

            $this->result = false;
        }
    }


    private function upload(): void
    {
        $slugImg   = new AdmsSlug();
        $this->nameImg = $slugImg->slug($this->dataImage['name']);


        $this->directory =   "app/adms/assets/image/users/" . $this->data['id'] . "/";

        $uploadImg  =  new AdmsUpload();
        $uploadImg->upload($this->directory, $this->dataImage['tmp_name'], $this->nameImg);

        if ($uploadImg->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }
    private function edit(): void
    {

        $this->data['image'] = $this->nameImg;

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
        if (((!empty($this->resultBd[0]['image'])) or ($this->resultBd[0]['image'] != null))  and ($this->resultBd[0]['image'] != $this->nameImg)) {
            $this->delImage = "app/adms/assets/image/users/" . $this->data['id'] . "/" . $this->resultBd[0]['image'];

            if (file_exists($this->delImage)) {
                unlink($this->delImage);
            }
        }

        $_SESSION['msg'] = "User Edit Image sucessfully link 153";
        $this->result = true;
    }
}
