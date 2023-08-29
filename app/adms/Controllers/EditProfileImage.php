<?php


namespace App\Adms\Controllers;


if(!defined('C8L6K7E')){
  header("Location: http://localhost/admin/");
}


use Core\ConfigView;
use App\Adms\Models\AdmsAddUsers;
use App\Adms\Models\AdmsEditUser;
use App\Adms\Models\AdmsEditProfile;
use App\Adms\Models\AdmsEditProfileImage;


class EditProfileImage
{

  private ?array $data = [];
  private ?array $dataForm;

  public function index(): void
  {

    $this->dataForm =  filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($this->dataForm['SendEditProfImage'])) {

      // var_dump($this->dataForm);
      $this->editProfileImage();
    } else {

      $editProfileImg = new AdmsEditProfileImage();
      $editProfileImg->editProfileImage();


      if ($editProfileImg->getResult()) {
        $this->data['form'] =  $editProfileImg->getResultBd();
        // var_dump($this->data['form']);

        $this->viewEditProfileImg();
      } else {
        $urlRedirect =  URLADM . "login/index/";
        header("Location: " . $urlRedirect);
      }
      // $this->editUser();
    }
  }





  private function editProfileImage(): void
  {
    if (!empty($this->dataForm['SendEditProfImage'])) {
      unset($this->dataForm['SendEditProfImage']);
      $this->dataForm['new_image'] =  $_FILES['new_image'] ? $_FILES['new_image'] : null;

      $editProfImage =  new AdmsEditProfileImage();
      $editProfImage->update($this->dataForm);

      if ($editProfImage->getResult()) {
        $urlRedirect =  URLADM . "view-profile/index/";
        header("Location: " . $urlRedirect);
      } else {
        $this->data['form'] = $this->dataForm;

        $this->viewEditProfileImg();
      }
    } else {
      $_SESSION['msg'] = "<p style='color: #f00'>Nenhum user encontrado</p>";
      $urlRedirect =  URLADM . "login/index";
      header("Location: " . $urlRedirect);
    }
  }


  private function viewEditProfileImg(): void
  {

    $loadView =   new ConfigView("adms/Views/users/editProfileImage", $this->data);
    $loadView->loadView();
  }
}
