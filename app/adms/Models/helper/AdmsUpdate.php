<?php


namespace App\Adms\Models\helper;

use PDO;
use PDOException;

class AdmsUpdate extends AdmsConn
{

    private string $table;
    private ?string $terms;
    private array $data;
    private array $value = [];
    private ?string $result;
    private object $update;
    private string $query;
    private object $conn;


    function getResult(): ?string
    {
        return $this->result;
    }




    public function exeUpdate(string $table, array $data, ?string $terms = null, ?string $parseString = null): void
    {
        $this->table = $table;
        $this->data = $data;
        $this->terms = $terms;


  
        parse_str($parseString, $this->value);

        $this->exeReplaceValues();
    }

    private function exeReplaceValues(): void
    {
        foreach ($this->data as $key => $value) {
            $values[] = $key . "=:" . $key;

            var_dump($values);
        }
        $values = implode(', ', $values);

        var_dump($values);

        $this->query = "UPDATE {$this->table} SET {$values} {$this->terms} ";
        $this->exeInstruction();
    }


    private function exeInstruction(): void
    {
        $this->connection();

        try {
            $this->update->execute(array_merge($this->data, $this->value));
            $this->result = true;
        } catch (PDOException $th) {

            $this->result = null;
            throw $th;
        }
    }
    private function connection(): void
    {
        $this->conn = $this->connectDb();
        $this->update  =  $this->conn->prepare($this->query);
    }
}
