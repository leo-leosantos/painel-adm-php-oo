<?php


namespace App\Adms\Controllers;
use App\Adms\Models\AdmsDashboard;

if(!defined('C8L6K7E')){
    header("Location: http://localhost/admin/");
}

use Core\ConfigView;

class Dashboard
{
    private ?array $data;





    public function index(): void
    {

        $countUsers =  new AdmsDashboard();
        $countUsers->countUsers();

       // var_dump($countUsers);

        if($countUsers->getResult()){
           
             $this->data['countUsers'] = $countUsers->getResultBd();
        }else{
            $this->data['countUsers'] = false;
        }
        $this->data['sidebarActive']= "dashboard";

        $loadView =   new ConfigView("adms/Views/dashboard/dashboard", $this->data);
        $loadView->loadView();   
     }
}