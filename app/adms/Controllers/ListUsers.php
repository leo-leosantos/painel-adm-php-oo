<?php


namespace App\Adms\Controllers;
if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
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
            $this->data['pagination'] = $listUsers->getResultPg();
           // var_dump($this->data);

        } else {
            $this->data['listUsers'] = [];

            $_SESSION['msg'] = "<p style='color: #f00'>Nenhum ususer encontrado</p>";
        }
        //var_dump($this->data);
        $this->data['sidebarActive']= "list-users";

        $loadView =   new ConfigView("adms/Views/users/listUsers", $this->data);
        $loadView->loadView();
    }
}