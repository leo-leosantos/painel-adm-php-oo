<?php


namespace App\Adms\Models\helper;

use PDO;
use PDOException;

class AdmsRead extends AdmsConn
{

    private string $select;
    private array $values = [];
    private ?array $result;
    private object $query;
    private object $conn;


    function getResult(): ?array
    {
        return $this->result;
    }

    public function exeRead(string $table, ?string $terms = null, ?string $parseString = null): void
    {

        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }
        $this->select = "SELECT * FROM {$table} {$terms} ";

        $this->exeInstruction();
    }

    public function fullRead(string $query, ?string $parseString = null): void
    {
        $this->select = $query;
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }
        $this->exeInstruction();

    }

    private function exeInstruction(): void
    {
        $this->connection();
        try {
            $this->exeParameter();
            
            $this->query->execute();
            $this->result =  $this->query->fetchAll();
        } catch (PDOException $pdoError) {
            $this->result = null;
        }
    }

    private function exeParameter(): void
    {
        if ($this->values) {
            foreach ($this->values as $link => $value) {
                if (($link == 'limit') or ($link == 'offset') or ($link == 'id')) {
                    $value = (int) $value;
                }
                $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }




    private function connection(): void
    {
        $this->conn = $this->connectDb();
        $this->query  =  $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }
}
