<?php
if(!defined('C8L6K7E')){
    header("Location: http://localhost/admin/");
    die('not found');
}
?>

<a href="<?php echo URLADM ; ?>dashboard/index">Dashboard</a><br>
<a href="<?php echo URLADM ; ?>list-users/index">Usuarios</a><br>
<a href="<?php echo URLADM ; ?>view-profile/index">Pefil</a><br>

<a href="<?php echo URLADM ; ?>logout/index">Sair</a><br><br>