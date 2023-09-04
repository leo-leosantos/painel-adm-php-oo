<?php
if(!defined('C8L6K7E')){
    header("Location: http://localhost/admin/");
    die('not found');
}
?>

<a href="<?= URLADM ; ?>dashboard/index">Dashboard</a><br>
<a href="<?= URLADM ; ?>list-users/index">Usuarios</a><br>
<a href="<?php echo URLADM; ?>list-colors/index">Cores</a><br>

<a href="<?= URLADM ; ?>view-profile/index">Pefil</a><br>
<a href="<?= URLADM ; ?>list-sits-users/index">Situações</a><br>
<a href="<?= URLADM ; ?>logout/index">Sair</a><br><br>