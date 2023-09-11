<?php

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
};

?>

 <!-- Inicio do conteudo do administrativo -->
 <div class="wrapper">
            <div class="row">
                <div class="top-list">
                    <span class="title-content">Listar Usuários</span>
                    <div class="top-list-right">
                    <?php echo  "<a href='".URLADM."add-users/index/' class='btn-success' >Cadastrar</a>" ;?>
                        <!--<button type="button" class="btn-success"><i class="fa-solid fa-square-plus"></i></button>-->
                    </div>
                </div>
                <div class="content-adm">
                        <?php  
                            if(isset($_SESSION['msg'])){
                                echo $_SESSION['msg'];
                                unset ($_SESSION['msg']);
                            }
                        ?>
                </div>

                <table class="table-list">
                    <thead class="list-head">
                        <tr>
                            <th class="list-head-content">ID</th>
                            <th class="list-head-content">Nome</th>
                            <th class="list-head-content table-sm-none">E-mail</th>
                            <th class="list-head-content table-sm-none">Situação</th>
                            <th class="list-head-content table-md-none">Cadastrado</th>
                            <th class="list-head-content">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="list-body">

                        <?php
                        foreach($this->data['listUsers'] as $user){
                            extract($user);
                        
                        ?>
                        <tr>
                            <td class="list-body-content"><?= $id ;?></td>
                            <td class="list-body-content"><?= $name_usr ; ?></td>
                            <td class="list-body-content table-sm-none"><?= $email; ?></td>
                            <td class="list-body-content table-sm-none"> <?= 
                                "<span style='color: $color'>$name_sit</span>" ;?>
                            </td>
                            <td class="list-body-content table-md-none"><?= $created ?></td>
                            <td class="list-body-content">
                                <div class="dropdown-action">
                                    <button onclick="actionDropdown(<?php echo  $id ;?>)" class="dropdown-btn-action">Ações</button>
                                    <div id="actionDropdown<?php echo  $id ;?>" class="dropdown-action-item">

                                    <?php 
                                     
                                     echo "<a href='".URLADM."view-users/index/$id'  >Visualizar</a>" ;
                                     echo   "<a href='".URLADM."edit-users/index/$id'  >Editar</a>" ;
                                     echo   "<a href='".URLADM."delete-users/index/$id' onclick='return confirm(\"Excluir tem certeza ?\")'>Apagar</a>" ;
                                    
                                    ?>

                                    
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                   
                    </tbody>
                </table>

                
             <?= $this->data['pagination'] ; ?>
         

        
            </div>
        </div>
