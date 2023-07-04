<?php


namespace App\Adms\Controllers;

use Core\ConfigView;

class ViewUsers
{

    private array $data;
    public function index(): void
    {

        $this->data = [];
        $loadView =   new ConfigView("adms/Views/users/viewUser", $this->data);
        $loadView->loadView();
    }
}
