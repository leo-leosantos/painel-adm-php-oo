<?php


namespace App\Adms\Controllers;

use Core\ConfigView;

class Dashboard
{
    private ?array $data;

    public function index(): void
    {
        $this->data = ["Bem vindo"];
        $loadView =   new ConfigView("adms/Views/dashboard/dashboard", $this->data);
        $loadView->loadView();   
     }
}