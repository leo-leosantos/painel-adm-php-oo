<?php
    require './vendor/autoload.php';
    use Core\ConfigController;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
</head>

<body>
    <?php

        
            $home = new  ConfigController();
            $home->loadPage();


            ?>
</body>

</html>