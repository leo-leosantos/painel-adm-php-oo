<?php


namespace App\Adms\Models;

use App\Adms\Models\helper\AdmsRead;


class AdmsDashboard
{
    private bool $result;
    private ?array $resultBd = [];

    function getResult(): bool
    {
        return $this->result;
    }

    function getResultBd(): ?array
    {
        return $this->resultBd;
    }

    public function countUsers(): void
    {
        $countUsers =   new AdmsRead();
        $countUsers->fullRead(
            "SELECT COUNT(id) as qnt_users FROM adms_users");
           // var_dump($countUsers);
        $this->resultBd =  $countUsers->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }
}
