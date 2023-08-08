<?php


namespace App\Adms\Controllers;

use App\Adms\Models\AdmsConfEmail;
use App\Adms\Models\AdmsNewConfEmail;
use Core\ConfigView;

class NewConfEmail
{
    private ?array $data = [];
    private ?array $dataForm;
    //http://localhost/admin/new-conf-email/index
    public function index(): void
    {
        $this->dataForm =    filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(! empty($this->dataForm['SendNewConfEmail'])){
            unset($this->dataForm['SendNewConfEmail']);
            $newConfEmail   = new AdmsNewConfEmail();
            $newConfEmail->newConfEmail($this->dataForm);
            if($newConfEmail->getResult()){

                $urlRedirect =  URLADM . "login/index";
                header("Location: " . $urlRedirect);
                
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewNewConfEmail();
            }
        }else{
            $this->viewNewConfEmail();

        }
    }


    private function viewNewConfEmail(): void
    {

        $loadView = new ConfigView("adms/views/login/newConfEmail", $this->data);
        $loadView->loadViewLogin();
    }
}
