<?php


namespace App\Adms\Controllers;

if(!defined('C8L6K7E')){
    header("Location: http://localhost/admin/");
}

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