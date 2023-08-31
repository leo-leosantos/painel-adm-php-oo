<?php


namespace App\Adms\Controllers;

use App\Adms\Models\AdmsListUsers;
use Core\ConfigView;


class ListUsers
{
    private ?array $data;
    private ?string $page;

    public function index(?string $page ): void
    {
        $this->page =   (int) $page ? $page : 1;

       // var_dump($this->page);

        $listUsers = new AdmsListUsers();
        $listUsers->listUsers($this->page);
    
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