<?php


namespace App\Adms\Controllers;

use App\Adms\Models\AdmsLogin;
use Core\ConfigView;

class Login
{

    private ?array $data = [];
    private ?array $dataForm;

    public function index(): void
    {
        $this->dataForm   =  filter_input_array(INPUT_POST, FILTER_DEFAULT);

           if(!empty($this->dataForm['SendLogin'])){
             $valLogin = new AdmsLogin();
             $valLogin->login($this->dataForm);
             if($valLogin->getResult()){
                 $urlRedirect =  URLADM . "dashboard/index";
                 header("Location: " . $urlRedirect);
             }else{
               $this->data['form'] = $this->dataForm;

             }
           }
        
        $loadView =   new ConfigView("adms/Views/login/login", $this->data);
        $loadView->loadView();   
     }
}