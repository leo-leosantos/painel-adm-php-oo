<?php


namespace App\Adms\Controllers;

use App\Adms\Models\AdmsListUsers;
use Core\ConfigView;


class ListUsers
{
    private ?array $data;
    public function index(): void
    {



        $listUsers = new AdmsListUsers();
        $listUsers->listUsers();
    
        if ($listUsers->getResult()) {
            $this->data['listUsers'] = $listUsers->getResultBd();
        } else {
            $this->data['listUsers'] = [];

            $_SESSION['msg'] = "<p style='color: #f00'>Nenhum ususer encontrado</p>";
        }
        $loadView =   new ConfigView("adms/Views/users/listUsers", $this->data);
        $loadView->loadView();
    }
}