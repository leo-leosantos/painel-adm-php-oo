<?php


namespace App\Adms\Controllers;

use App\Adms\Models\AdmsRecoveryPass;
use Core\ConfigView;

class RecoveryPassword
{ 
    
    private ?array $data = [];
    private ?array $dataForm;

    public function index(): void
    {
        
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

      
            if(!empty($this->dataForm['SendRecoverPass'])){
                unset($this->dataForm['SendRecoverPass']);
                 $recoveryPass =  new AdmsRecoveryPass();
               
                 $recoveryPass->recoveryPassword($this->dataForm);
                 var_dump( $recoveryPass->getResult());
                 if($recoveryPass->getResult()){
                    $urlRedirect =  URLADM . "login/index";
                    header("Location: " . $urlRedirect);

                 }else{
                    $this->data['form'] = $this->dataForm;

                    $this->viewRecoveryPass();

                 }
            }else{
                $this->viewRecoveryPass();
            }
    }


     private function viewRecoveryPass(): void
     {
        $loadView = new ConfigView("adms/views/login/recoveryPassword", $this->data);
        $loadView->loadView();    
     }



}