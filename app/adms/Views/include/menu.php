<?php
if(!defined('C8L6K7E')){
    header("Location: http://localhost/admin/");
    die('not found');
}


$sidebar_active = "";

if(isset($this->data['sidebarActive'])){
    $sidebar_active = $this->data['sidebarActive'];

}

?>
  <!-- Inicio Conteudo -->
  <div class="content">
        <!-- Inicio da Sidebar -->
        <div class="sidebar">
        <?php
            $dashboard= "";
                 if($sidebar_active == "dashboard") {$dashboard = "active"; }   ?>

            <a href="<?= URLADM ; ?>dashboard/index" class="sidebar-nav <?= $dashboard ?>  ">
            <i class="icon fa-solid fa-house"></i><span>Dashboard</span></a>
           

            <?php
            $list_users= "";
                 if($sidebar_active == "list-users") {$list_users = "active"; }   ?>
            <a href="<?= URLADM ; ?>list-users/index" class="sidebar-nav  <?= $list_users ?>" >
            <i class="icon fa-solid fa-users"></i><span>Usuários</span></a>


            <?php
            $list_sit_users= "";
                 if($sidebar_active == "list-sits-users") {$list_sit_users = "active"; }   ?>
            <a href="<?= URLADM ; ?>list-sits-users/index" class="sidebar-nav  <?= $list_sit_users ?>"><i class="icon fa-solid fa-user-check"></i><span>Situação dos Usuarios</span></a>
            
            
            <?php
            $list_colors= "";
                 if($sidebar_active == "list-colors") {$list_colors = "active"; }   ?>
            <a href="<?php echo URLADM; ?>list-colors/index" class="sidebar-nav <?= $list_colors ?>"><i class="icon fa-solid fa-palette"></i><span>Cores</span></a>
            
            <a href="<?php echo URLADM; ?>list-conf-emails/index" class="sidebar-nav"><i class="icon fa-solid fa-envelope"></i><span>Configurações</span></a>
       
            <a href="<?= URLADM ; ?>logout/index" class="sidebar-nav"><i class="icon fa-solid fa-arrow-right-from-bracket"></i><span>Sair</span></a>

        </div>
        <!-- Fim da Sidebar -->
