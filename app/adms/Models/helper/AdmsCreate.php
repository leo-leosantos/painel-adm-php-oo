<?php


namespace App\Adms\Models\helper;

use PDOException;

class AdmsCreate extends AdmsConn
{

    private string $table;
    private array $data;
    private ?string $result;
    private object $insert;
    private string $query;
    private object $conn;


    function getResult()
    {
        return $this->result;
    }


    public function exeCreate(string $table, array $data): void
    {
        $this->table = $table;
        $this->data = $data;

        $this->exeReplaceValues();

    }


    private function exeReplaceValues()
    {
        $coluns = implode(', ', array_keys($this->data));
        $values = ':' . implode(', :', array_keys($this->data));
        $this->query = "INSERT INTO {$this->table} ($coluns) VALUES ($values)";
        $this->exeInstruction();

    }

    private function exeInstruction()
    {
        $this->connection();

        try {
            $this->insert->execute($this->data);
            $this->result =  $this->conn->lastInsertId();
        } catch (PDOException $pdoError) {
           $this->result = null;
        }
    }

    private function connection(): void
    {
        $this->conn = $this->connectDb();
        $this->insert  =  $this->conn->prepare($this->query);
    }
}
