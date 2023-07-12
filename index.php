<?php
   session_start();
    ob_start();
    
    require './vendor/autoload.php';
            use Core\ConfigController;

    $home = new  ConfigController();
    $home->loadPage();

   
        


