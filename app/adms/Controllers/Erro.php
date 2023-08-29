<?php


namespace App\Adms\Controllers;
if(!defined('C8L6K7E')){
    header("Location: http://localhost/admin/");
}

use Core\ConfigView;

class Erro
{
    private ?array $data;

    public function index(): void
    {
        echo  "pagina Error Index<br>"; 
        $this->data = ["Page not found"];
        $loadView =   new ConfigView("adms/Views/error/error", $this->data);
        $loadView->loadViewLogin();   
     }





}