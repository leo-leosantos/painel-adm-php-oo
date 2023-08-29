<?php
   session_start();
    ob_start();
    
    define('C8L6K7E',true);
    require './vendor/autoload.php';
            use Core\ConfigController;

    $home = new  ConfigController();
    $home->loadPage();

   
        


