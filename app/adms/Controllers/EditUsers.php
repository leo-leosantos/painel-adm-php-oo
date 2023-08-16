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

    $this->dataForm =  filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // var_dump( $this->dataForm);


    if ((!empty($id)) and (empty($this->dataForm['SendEditUser']))) {
      $this->id = (int) $id;
      // var_dump( $this->dataForm);

      $viewUser =   new  AdmsEditUser();
      $viewUser->viewUser($this->id);
      if ($viewUser->getResult()) {
        $this->data['form'] =  $viewUser->getResultBd();
        //  var_dump( $this->dataForm);

        $this->viewEditNewUser();
      } else {
        $urlRedirect =  URLADM . "list-users/index";
        header("Location: " . $urlRedirect);
      }
    } else {
      // $_SESSION['msg'] = "<p style='color: #f00'>Nenhum user encontrado</p>";
      // $urlRedirect =  URLADM . "list-users/index";
      // header("Location: " . $urlRedirect);
      // var_dump( $this->dataForm);

      $this->editUser();
    }
  }





  private function editUser(): void
  {
    if (!empty($this->dataForm['SendEditUser'])) {
      unset($this->dataForm['SendEditUser']);
      $editUser =  new AdmsEditUser();
      $editUser->update($this->dataForm);
      if ($editUser->getResult()) {
        $urlRedirect =  URLADM . "view-users/index/".$this->dataForm['id'];
        header("Location: " . $urlRedirect);
      } else {
        $this->data['form'] = $this->dataForm;

        $this->viewEditNewUser();
      }
    } else {
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
