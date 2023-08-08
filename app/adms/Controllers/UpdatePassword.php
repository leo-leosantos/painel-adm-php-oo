<?php


namespace App\Adms\Controllers;

use App\Adms\Models\AdmsUpdatePassword;
use Core\ConfigView;

class UpdatePassword
{
    private ?string $key;
    private ?array $data = [];
    private ?array $dataForm;

    public function index(): void
    {
        $this->key = filter_input(INPUT_GET, "key", FILTER_DEFAULT);

        $this->dataForm =   filter_input_array(INPUT_POST, FILTER_DEFAULT);



        if ((!empty($this->key)) and (empty($this->dataForm['SendUpPass']))) {

            $this->validateKey();
        } else {
            $this->updatePassword();
            //     $_SESSION['msg'] = "Error link invaldido index onfEmail";
            //     $urlRedirect =  URLADM . "login/index";
            //     header("Location: " . $urlRedirect);
        }
    }


    private function validateKey(): void
    {
        $valkey = new AdmsUpdatePassword();
        $valkey->valKey($this->key);

        if ($valkey->getResult()) {
            $this->viewUpdatePassword();
        } else {
            $urlRedirect =  URLADM . "login/index";
            header("Location: " . $urlRedirect);
        }
    }

    private function updatePassword(): void
    {
        if (!empty($this->dataForm['SendUpPass'])) {
            unset($this->dataForm['SendUpPass']);
            $this->dataForm['key'] = $this->key;

            $updatePassword = new  AdmsUpdatePassword();
            $updatePassword->editPassword($this->dataForm);

               if( $updatePassword->getResult()){
                $urlRedirect =  URLADM . "login/index";
                header("Location: " . $urlRedirect);
               }else{
                $this->viewUpdatePassword();

               }
        }else{
            $_SESSION['msg'] = "Error: link invalid updatePassword linha 58 ";

            $urlRedirect =  URLADM . "login/index";
            header("Location: " . $urlRedirect);
        }
    }


    private function viewUpdatePassword(): void
    {
        $loadView =   new ConfigView("adms/Views/login/updatePassword", $this->data);
        $loadView->loadViewLogin();
    }
}
