<?php


namespace App\Adms\Controllers;

use App\Adms\Models\AdmsViewUser;
use Core\ConfigView;

class ViewUsers
{

    private array $data = [];
    private ?string $id;

    public function index(  ?string $id = null): void
    {


        if(!empty($id)){
            $this->id = (int) $id;

           // var_dump($this->id = (int) $id);
            $viewUser = new AdmsViewUser();
            $viewUser->viewUser($this->id);


            if($viewUser->getResult()){

                    $this->data['viewUser'] = $viewUser->getResultBd();
                  // var_dump($this->data['viewUser'] );

                    $this->loadView();
            }else{
                
        
                $urlRedirect =  URLADM . "list-users/index";
                header("Location: " . $urlRedirect);
             }
        }else{
            $_SESSION['msg'] = "<p style='color: #f00'>Nenhum user encontrado</p>";
            $urlRedirect =  URLADM . "list-users/index";
            header("Location: " . $urlRedirect);
        }
       
    }


    private function loadView()
    {
        $loadView =   new ConfigView("adms/Views/users/viewUser", $this->data);
        $loadView->loadView();
    }

}
