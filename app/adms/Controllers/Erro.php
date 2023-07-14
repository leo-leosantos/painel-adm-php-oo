<?php


namespace App\Adms\Controllers;

use Core\ConfigView;

class Erro
{
    private ?array $data;

    public function index(): void
    {
        echo  "pagina Error Index<br>"; 
        $this->data = ["Page not found"];
        $loadView =   new ConfigView("adms/Views/error/error", $this->data);
        $loadView->loadView();   
     }





}