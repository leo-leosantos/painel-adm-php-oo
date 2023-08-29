<?php


if(!defined('C8L6K7E')){
    header("Location: http://localhost/admin/");
   // die("Error: pagina not found");
}

echo "pagina  dashboard<br>";

echo $this->data[0]. "  " . $_SESSION['user_name'] . "!<br>";