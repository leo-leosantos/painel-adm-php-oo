<?php

namespace App\adms\Controllers;

use App\adms\Models\AdmsListSitsUsers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller listar situação usuário
 * @author Cesar <cesar@celke.com.br>
 */
class ListSitsUsers
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private ?array $data;

    /**
     * Método listar situação usuário.
     * 
     * Instancia a MODELS responsável em buscar os registros no banco de dados.
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senão enviar o array de dados vazio.
     *
     * @return void
     */
    public function index(): void
    {
        $listSitsUsers = new AdmsListSitsUsers();
        $listSitsUsers->listSitsUsers();
        if ($listSitsUsers->getResult()) {
            $this->data['listSitsUsers'] = $listSitsUsers->getResultBd();
        } else {
            $this->data['listSitsUsers'] = [];
        }

        $this->data['sidebarActive']= "list-sits-users";

        $loadView = new \Core\ConfigView("adms/Views/sitsUser/listSitUser", $this->data);
        $loadView->loadView();
    }
}
