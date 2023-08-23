<?php


namespace App\Adms\Models\helper;

use PDO;
use PDOException;

class AdmsDelete extends AdmsConn
{

    private string $table;
    private ?string $terms;
    private array $value = [];
    private bool $result;
    private object $delete;
    private string $query;
    private object $conn;


    function getResult(): bool
    {
        return $this->result;
    }

    public function exeDelete(string $table, ?string $terms = null, ?string $parseString = null): void
    {
        $this->table = $table;
        $this->terms = $terms;
        parse_str($parseString, $this->value);

        $this->query = "DELETE FROM {$this->table} {$this->terms}";


        var_dump($this->query);
      $this->exeInstruction();
    }

 


    private function exeInstruction(): void
    {
       $this->connection();

        try {
            $this->delete->execute($this->value);

            $this->result = true;

        }catch(PDOException $err){
            $this->result = false;
        }

            
     
    }
    private function connection(): void
    {
        $this->conn = $this->connectDb();
        $this->delete  =  $this->conn->prepare($this->query);
    }
}
