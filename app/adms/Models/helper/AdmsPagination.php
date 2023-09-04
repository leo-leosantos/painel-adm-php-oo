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
    private ?string $result;
    private int $totalPages;
    private int $maxLinks = 2;
    private string $link;
    private ?string $var = null;



    function getOffset(): int
    {
        return $this->offset;
    }
    function getResult(): ?string
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
        $this->offset = (int) ($this->page * $this->limitResult) - $this->limitResult;


    }


    public function pagination ( string $query, ?string $parseString = null): void
    {
        $this->query = (string)$query;
        $this->parseString = (string) $parseString;

        $count = new AdmsRead();
        $count->fullRead($this->query, $this->parseString);

        $this->resultBd = $count->getResult();
        $this->pageInstruction();

    }

    private function pageInstruction(): void
    {

        $this->totalPages = (int) ceil ($this->resultBd[0]['num_result'] / $this->limitResult);

            if($this->totalPages >= $this->page){
                    $this->layoutPagination();
            }else{
                header("Location: {$this->link}");
            }

    }


    private function layoutPagination(): void
    {
        $this->result = "<ul>";
        $this->result .= "<li><a href='{$this->link}{$this->var}'>Primeira</a></li>";
            for ($beforePage= $this->page - $this->maxLinks  ;  $beforePage <= $this->page -1; $beforePage++) { 

                if($beforePage >=1){
                    $this->result .= "<li><a href='{$this->link}/$beforePage{$this->var}'>$beforePage</a></li>";

                }
                
            }

        $this->result .= "<li>{$this->page}</li>";

        for ($afterPage= $this->page +1  ;  $afterPage <= $this->page + $this->maxLinks; $afterPage++) { 

            if($afterPage <= $this->totalPages){

                $this->result .= "<li><a href='{$this->link}/$afterPage{$this->var}'>$afterPage</a></li>";

            }

            
        }
        $this->result .= "<li><a href='{$this->link}/{$this->totalPages}{$this->var}'>Ultima</a></li>";

        $this->result .= "</ul>";

    }
}
