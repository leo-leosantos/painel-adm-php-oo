<?php


namespace App\Adms\Controllers;

use Core\ConfigView;

class Login
{

    private ?array $data;

    public function index(): void
    {
        echo  "pagina Login Index<br>"; 
        $this->data = null;
        $loadView =   new ConfigView("adms/Views/login/login", $this->data);
        $loadView->loadView();   
     }
}