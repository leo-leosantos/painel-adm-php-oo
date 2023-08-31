<?php


namespace App\Adms\Models\helper;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

class AdmsPagination
{

    private int $page;
    private int $limitResult;
    private int $offset;
    private string $query;
    private ?string $parseString;
    private array $resultBd;
    private array $result;
    private int $totalPages;
    private int $maxLinks = 2;
    private string $link;
    private ?string $var = null;



    function offset()
    {
        return $this->offset;
    }
    function getResult()
    {
        return $this->result;
    }


    function __construct( string $link, ?string $var = null ){
        $this->link = $link;
        $this->var = $var;

    }

    public function condition( int $page, int $limitResult): void
    {
        $this->page =   (int) $page ? $page : 1;

        $this->limitResult =   (int) $limitResult ;

       // var_dump([$this->page, $this->limitResult]);        

    }


    public function pagination ( string $query, ?string $parseString = null): void
    {
        $this->query = (string)$query;
        $this->parseString = (string) $parseString;

       // var_dump([$this->query, $this->parseString]);     
       
        $count = new AdmsRead();
        $count->fullRead($this->query, $this->parseString);
       $this->resultBd = $count->getResult();

       $this->pageInstruction();

    }

    private function pageInstruction(): void
    {
                var_dump(($this->resultBd[0]['num_result']));

        $this->totalPages = (int) ceil ($this->resultBd[0]['num_result'] / $this->limitResult);

            if($this->totalPages >= $this->page){

            }else{
                header("Location: {$this->link}");
            }

    }
}
