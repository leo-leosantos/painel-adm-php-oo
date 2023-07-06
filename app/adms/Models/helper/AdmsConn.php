<?php


namespace App\Adms\Models\helper;

use PDO;
use PDOException;

/**
 * conexão com obanco de dados
 */
abstract class AdmsConn
{
    private string $host = HOST;
    private string $user = USER;
    private string $password = PASSWORD;
    private string $dbname = DBNAME;
    private int $port = PORT;
    private object $connect;


    protected function connectDb(): object
    {
        try {
            return $this->connect = new PDO("mysql:host={$this->host};port={$this->port};dbname=" . $this->dbname, $this->user, $this->password);
        } catch (PDOException $e) {

            die("Error system. Please to email support" . EMAILADMIN);
        }
    }
}
