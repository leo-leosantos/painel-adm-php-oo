<?php


namespace App\Adms\Controllers;

use App\Adms\Models\AdmsLogin;
use App\Adms\Models\AdmsNewUser;
use Core\ConfigView;

class NewUser
{

    private ?array $data = [];
    private ?array $dataForm;

    public function index(): void
    {


        $this->dataForm   =  filter_input_array(INPUT_POST, FILTER_DEFAULT);

           if(!empty($this->dataForm['SendNewUser'])){
             $createNewUser = new AdmsNewUser();
             $createNewUser->create($this->dataForm);
             if($createNewUser->getResult()){
                 $urlRedirect =  URLADM;
                 header("Location: " . $urlRedirect);
             }else{
               $this->data['form'] = $this->dataForm;
               $this->viewNewUser();

             }
           }else{
            $this->viewNewUser();
           }

       // $this->data = null;
        
       
     }


     private function viewNewUser(): void
     {
      $loadView =   new ConfigView("adms/Views/login/newUser", $this->data);
      $loadView->loadView();  
     }
}