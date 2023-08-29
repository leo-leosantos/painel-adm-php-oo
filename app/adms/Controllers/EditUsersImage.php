<?php


namespace App\Adms\Controllers;

use Core\ConfigView;
use App\Adms\Models\AdmsAddUsers;
use App\Adms\Models\AdmsEditUser;
use App\Adms\Models\AdmsEditUserImage;

class EditUsersImage
{

  private ?array $data = [];
  private ?array $dataForm;
  private ?string $id;

  public function index(?string $id = null): void
  {

    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);


    if ((!empty($id)) and (empty($this->dataForm['SendEditUserImage']))) {
      $this->id = (int) $id;

      $editImage = new AdmsEditUserImage();
      $editImage->editUserImage($this->id);
      if ($editImage->getResult()) {
        $this->data['form'] = $editImage->getResultBd();

        $this->viewEditUserImage();
      } else {
        $urlRedirect = URLADM . "list-users/index";
        header("Location: " . $urlRedirect);
      }
    } else {

      $this->editUserImage();
    }
  }





  private function editUserImage(): void
  {
    if (!empty($this->dataForm['SendEditUserImage'])) {
      unset($this->dataForm['SendEditUserImage']);

      $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null;

      $editUserImage = new AdmsEditUserImage();
      $editUserImage->update($this->dataForm);

      if ($editUserImage->getResult()) {
        $urlRedirect = URLADM . "view-users/index/" . $this->dataForm['id'];
        header("Location: " . $urlRedirect);
      } else {
        $this->data['form'] = $this->dataForm;

        $this->viewEditUserImage();
      }
    } else {
      $_SESSION['msg'] = "<p style='color: #f00'>Nenhum user encontrado</p>";
      $urlRedirect = URLADM . "list-users/index";
      header("Location: " . $urlRedirect);
    }
  }


  private function viewEditUserImage(): void
  {
    $loadView = new ConfigView("adms/Views/users/editUserImage", $this->data);
    $loadView->loadView();
  }
}