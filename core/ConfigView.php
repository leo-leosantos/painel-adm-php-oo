<?php

namespace Core;


class ConfigView
{

    private string $nameView;
    private ?array $data;

    public function __construct( string $nameView , ?array $data)
    {
        $this->nameView = $nameView;
        $this->data = $data;

    }


    public function loadView(): void
    {
        $file = 'app/' . $this->nameView .'.php';
            if(file_exists($file)){
               include $file;
            }else{
                die("Error view not found. Please to email for " . EMAILADMIN);

            }
    }
}