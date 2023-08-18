<?php


namespace App\Adms\Controllers;

use Core\ConfigView;
use App\Adms\Models\AdmsAddUsers;

class AddUsers
{

  private ?array $data = [];
  private ?array $dataForm;

  public function index(): void
  {


    $this->dataForm   =  filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($this->dataForm['SendAddNewUser'])) {
        unset($this->dataForm['SendAddNewUser']);

      $addNewUser = new AdmsAddUsers();
      $addNewUser->create($this->dataForm);
      if ($addNewUser->getResult()) {
        $urlRedirect =  URLADM . "list-users/index";
        header("Location: " . $urlRedirect);
      } else {
        $this->data['form'] = $this->dataForm;
        $this->viewAddNewUser();
      }
    } else {
      $this->viewAddNewUser();
    }
  }


  private function viewAddNewUser(): void
  {
    $listSelect =     new AdmsAddUsers();
    
    $this->data['select'] = $listSelect->listSelect();

    $loadView =   new ConfigView("adms/Views/users/addUser", $this->data);
    $loadView->loadView();
  }
}
