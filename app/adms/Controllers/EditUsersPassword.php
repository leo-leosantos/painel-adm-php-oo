<?php


namespace App\Adms\Controllers;

if(!defined('C8L6K7E')){
  header("Location: http://localhost/admin/");
}


use Core\ConfigView;
use App\Adms\Models\AdmsAddUsers;
use App\Adms\Models\AdmsEditUser;
use App\Adms\Models\AdmsEditUserPassword;

class EditUsersPassword
{

  private ?array $data = [];
  private ?array $dataForm;
  private ?string $id;

  public function index(?string $id = null): void
  {

    $this->dataForm =  filter_input_array(INPUT_POST, FILTER_DEFAULT);


    if ((!empty($id)) and (empty($this->dataForm['SendEditUserPass']))) {
      $this->id = (int) $id;

      $viewUserPass =   new  AdmsEditUserPassword();
      $viewUserPass->viewUser($this->id);
      if ($viewUserPass->getResult()) {
        $this->data['form'] =  $viewUserPass->getResultBd();

        $this->viewEditUserPass();
      } else {
        $urlRedirect =  URLADM . "list-users/index";
        header("Location: " . $urlRedirect);
      }
    } else {
    

      $this->editUserPass();
    }
  }





  private function editUserPass(): void
  {
    if (!empty($this->dataForm['SendEditUserPass'])) {
      unset($this->dataForm['SendEditUserPass']);
      $editUserPass =  new AdmsEditUserPassword();
      $editUserPass->update($this->dataForm);
      if ($editUserPass->getResult()) {
        $urlRedirect =  URLADM . "view-users/index/".$this->dataForm['id'];
        header("Location: " . $urlRedirect);
      } else {
        $this->data['form'] = $this->dataForm;

        $this->viewEditUserPass();
      }
    } else {
      $_SESSION['msg'] = "<p style='color: #f00'>Nenhum user encontrado</p>";
      $urlRedirect =  URLADM . "list-users/index";
      header("Location: " . $urlRedirect);
    }
  }


  private function viewEditUserPass(): void
  {
    $loadView =   new ConfigView("adms/Views/users/editUserPass", $this->data);
    $loadView->loadView();
  }
}
