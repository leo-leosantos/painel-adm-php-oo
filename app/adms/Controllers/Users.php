<?php


namespace App\Adms\Controllers;

use Core\ConfigView;


class Users
{
    private array $data;
    public function index(): void
    {

        $this->data = [];
        $loadView =   new ConfigView("adms/Views/users/users", $this->data);
        $loadView->loadView();
    }
}