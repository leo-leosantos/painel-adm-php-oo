<?php


namespace App\Adms\Controllers;

use App\Adms\Models\AdmsViewProfile;
use Core\ConfigView;

class ViewProfile
{

    private array $data = [];

    public function index(): void
    {

            $viewProfile = new AdmsViewProfile();
            $viewProfile->viewProfile();
            if ($viewProfile->getResult()) {

                $this->data['viewProfile'] = $viewProfile->getResultBd();
                $this->loadViewProfile();

            } else {
                $urlRedirect =  URLADM . "login/index";
                header("Location: " . $urlRedirect);
            }
        
    }


    private function loadViewProfile(): void
    {
        $loadView =   new ConfigView("adms/Views/users/viewUserProfile", $this->data);
        $loadView->loadView();
    }
}
