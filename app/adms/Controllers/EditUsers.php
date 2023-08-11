<?php


namespace App\Adms\Controllers;

use Core\ConfigView;
use App\Adms\Models\AdmsAddUsers;
use App\Adms\Models\AdmsEditUser;

class EditUsers
{

  private ?array $data = [];
  private ?array $dataForm;
  private ?string $id;

  public function index(?string $id = null): void
  {

    if(!empty($id)){
      $this->id = (int) $id;
        $viewUser =   new  AdmsEditUser();
        $viewUser->viewUser($this->id);
          if($viewUser->getResult()){
              $this->data['form'] =  $viewUser->getResultBd();
                $this->viewEditNewUser();
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


  private function viewEditNewUser(): void
  {
    $loadView =   new ConfigView("adms/Views/users/editUser", $this->data);
    $loadView->loadView();
  }
}
