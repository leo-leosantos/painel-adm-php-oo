<?php


namespace App\Adms\Controllers;

use Core\ConfigView;
use App\Adms\Models\AdmsAddUsers;
use App\Adms\Models\AdmsEditProfile;
use App\Adms\Models\AdmsEditUser;

class EditProfile
{

  private ?array $data = [];
  private ?array $dataForm;

  public function index(): void
  {

    $this->dataForm =  filter_input_array(INPUT_POST, FILTER_DEFAULT);



    if (! empty($this->dataForm['SendEditProfile'])) {

      var_dump($this->dataForm);
          $this->editProfile();
    } else {

         $editProfile =new AdmsEditProfile();
         $editProfile->viewProfile();


         if($editProfile->getResult()){
              $this->data['form'] =  $editProfile->getResultBd();
             // var_dump($this->data['form']);

              $this->viewEditProfile();
         }else{
          $urlRedirect =  URLADM . "login/index/";
          header("Location: " . $urlRedirect);
         }
      // $this->editUser();
    }
  }





  private function editProfile(): void
  {
    if (!empty($this->dataForm['SendEditProfile'])) {
      unset($this->dataForm['SendEditProfile']);

      $editUserProfile =  new AdmsEditProfile();
      $editUserProfile->update($this->dataForm);

      if ($editUserProfile->getResult()) {
        $urlRedirect =  URLADM . "view-profile/index/";
        header("Location: " . $urlRedirect);
      } else {
        $this->data['form'] = $this->dataForm;

        $this->viewEditProfile();
      }
    } else {
      $_SESSION['msg'] = "<p style='color: #f00'>Nenhum user encontrado</p>";
      $urlRedirect =  URLADM . "login/index";
      header("Location: " . $urlRedirect);
    }
  }


  private function viewEditProfile(): void
  {

    $loadView =   new ConfigView("adms/Views/users/editProfile", $this->data);
    $loadView->loadView();
  }
}
