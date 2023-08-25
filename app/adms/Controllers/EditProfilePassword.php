<?php


namespace App\Adms\Controllers;

use Core\ConfigView;
use App\Adms\Models\AdmsEditProfile;
use App\Adms\Models\AdmsEditProfilePassword;

class EditProfilePassword
{

  private ?array $data = [];
  private ?array $dataForm;

  public function index(): void
  {

    $this->dataForm =  filter_input_array(INPUT_POST, FILTER_DEFAULT);



    if (! empty($this->dataForm['SendEditProfPass'])) {

          $this->editProfPass();
    } else {

         $editProfPass =new AdmsEditProfilePassword();
         $editProfPass->viewProfile();


         if($editProfPass->getResult()){
              $this->data['form'] =  $editProfPass->getResultBd();

              $this->viewEditProfilePass();
         }else{
          $urlRedirect =  URLADM . "login/index/";
          header("Location: " . $urlRedirect);
         }
    }
  }





  private function editProfPass(): void
  {
    if (!empty($this->dataForm['SendEditProfPass'])) {
      unset($this->dataForm['SendEditProfPass']);


      $editUserProfilePass =  new AdmsEditProfilePassword();
      $editUserProfilePass->update($this->dataForm);

      if ($editUserProfilePass->getResult()) {
        $urlRedirect =  URLADM . "view-profile/index/";
        header("Location: " . $urlRedirect);
      } else {
        $this->data['form'] = $this->dataForm;

        $this->viewEditProfilePass();
      }
    } else {
      $_SESSION['msg'] = "<p style='color: #f00'>Nenhum user encontrado</p>";
      $urlRedirect =  URLADM . "login/index";
      header("Location: " . $urlRedirect);
    }
  }


  private function viewEditProfilePass(): void
  {

    $loadView =   new ConfigView("adms/Views/users/editProfilePassword", $this->data);
    $loadView->loadView();
  }
}
