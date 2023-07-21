<?php


namespace App\Adms\Controllers;

use App\Adms\Models\AdmsConfEmail;

class ConfEmail
{
    private ?string $key;

    public function index(): void
    {
        $this->key =  filter_input(INPUT_GET, "key", FILTER_DEFAULT);

        if (!empty($this->key)) {

            $this->valKey();
        } else {
            $_SESSION['msg'] = "Error link invaldido index onfEmail";
            $urlRedirect =  URLADM . "login/index";
            header("Location: " . $urlRedirect);
        }
    }

    private function valKey(): void
    {
        $confEmail = new AdmsConfEmail();
        $confEmail->confEmail($this->key);

        if ($confEmail->getResult()) {
            $urlRedirect =  URLADM . "login/index";
            header("Location: " . $urlRedirect);
        } else {
            $urlRedirect =  URLADM . "login/index";
            header("Location: " . $urlRedirect);
        }
    }
}
