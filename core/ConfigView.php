<?php

namespace Core;

if(!defined('C8L6K7E')){
    header("Location: http://localhost/admin/");
    die('not found');
}
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
                include 'app/adms/Views/include/head.php';
                include 'app/adms/Views/include/menu.php';
                include $file;
                include 'app/adms/Views/include/footer.php';
            }else{
                die("Error view not found. Please to email for " . EMAILADMIN);

            }
    }

    public function loadViewLogin(): void
    {
        $file = 'app/' . $this->nameView .'.php';
            if(file_exists($file)){
                include 'app/adms/Views/include/head_login.php';
                include $file;
                include 'app/adms/Views/include/footer_login.php';
            }else{
                die("Error view not found. Please to email for " . EMAILADMIN);

            }
    }
}