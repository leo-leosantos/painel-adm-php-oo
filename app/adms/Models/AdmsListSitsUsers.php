<?php

namespace App\adms\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Listar situacao usuários do banco de dados
 *
 * @author Celke
 */
class AdmsListSitsUsers
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private ?array $resultBd;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os registros do BD
     */
    function getResultBd(): ?array
    {
        return $this->resultBd;
    }

    public function listSitsUsers():void
    {
        $listSitsUsers = new \App\adms\Models\helper\AdmsRead();
        $listSitsUsers->fullRead("SELECT sit.id, sit.name,
                            col.color 
                            FROM adms_sists_users sit
                            INNER JOIN adms_colors AS col ON col.id=sit.adms_color_id
                            ORDER BY sit.id DESC");

        $this->resultBd = $listSitsUsers->getResult();        
        if($this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhuma situação encontrada!</p>";
            $this->result = false;
        }
    }

    
}
