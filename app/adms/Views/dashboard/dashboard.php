<?php
echo "pagina  dashboard<br>";

//var_dump($this->data[0]);
echo $this->data[0]. "  " . $_SESSION['user_name'] . "!<br>";

echo "<a href='".URLADM."logout/index'>Sair</a><br>";
?>