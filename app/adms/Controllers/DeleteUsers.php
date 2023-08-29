<?php


namespace App\Adms\Controllers;

if(!defined('C8L6K7E')){
  header("Location: http://localhost/admin/");
}


use Core\ConfigView;
use App\Adms\Models\AdmsAddUsers;
use App\Adms\Models\AdmsDeleteUser;
use App\Adms\Models\AdmsEditUser;

class DeleteUsers
{

  private ?array $data = [];
  private ?array $dataForm;
  private ?string $id;

  public function index(?string $id = null): void
  {

    if (!empty($id)) {
      $this->id = (int) $id;

      var_dump($this->id);
      $deleteUser =  new AdmsDeleteUser();
      $deleteUser->deleteUser($this->id);

    
    }else {
      $_SESSION['msg'] = "<p style='color: #f00'>Nenhum user encontrado</p>";
       
    }

    $urlRedirect =  URLADM . "list-users/index";
    header("Location: " . $urlRedirect);
  
  }



}
