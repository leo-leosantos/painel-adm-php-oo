<?php

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
};
?>

<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Detalhes do Usuario</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "list-users/index/' class='btn-info'>Listar</a>";

                if (!empty($this->data['viewUser'][0])) {

                    extract($this->data['viewUser'][0]);


                    echo " <a href='" . URLADM . "edit-users/index/" . $id .  "'class='btn-warning'>Editar</a> ";
                    echo " <a href='" . URLADM . "edit-users-password/index/$id'  class='btn-warning'>Editar Senha</a> ";
                    echo " <a href='" . URLADM . "edit-users-image/index/$id'  class='btn-warning'>Editar Image</a> ";
                    echo " <a href='" . URLADM . "delete-users/index/$id'  class='btn-danger' onclick='return confirm(\"Tem certeza que excluir?\")'>Apagar</a> ";
                }
                ?>
            </div>

            <div class="content-adm">
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            </div>
        </div>

        <div class="content-adm">
            <?php
            if (!empty($this->data['viewUser'][0])) {
                extract($this->data['viewUser'][0]);

            ?>

                <div class="view-det-adm">
                    <span class="view-adm-title">ID: </span>
                    <span class="view-adm-info"><?= $id; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-adm-title">Nome: </span>
                    <span class="view-adm-info"><?= $name_usr; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">E-mail: </span>
                    <span class="view-adm-info"><?= $email; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Apelido: </span>
                    <span class="view-adm-info"><?= $nickname; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">User: </span>
                    <span class="view-adm-info"><?= $user; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Situação: </span>
                    <span class="view-adm-info">
                        <?= "<span style='color:$color;'>$name_sit </span>"; ?>
                    </span>
                </div>
                <div class="view-det-adm">
                    <span class="view-adm-title">Criado: </span>
                    <span class="view-adm-info"><?= date('d-m-Y H:i:s', strtotime($created)) ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Moidificado: </span>
                    <span class="view-adm-info"><?php
                                                if (!empty($modified)) {
                                                    echo   date('d-m-Y H:i:s', strtotime($modified));
                                                } ?>
                    </span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Foto: </span>
                    <span class="view-adm-info"><?php
                                                if ((!empty($image))
                                                    and (file_exists("app/adms/assets/image/users/$id/$image"))
                                                ) {
                                                    echo  "<img src='" . URLADM . "app/adms/assets/image/users/$id/$image' width='100' height='100'><br><br>";
                                                } else {
                                                    echo  "<img src='" . URLADM . "app/adms/assets/image/users/user.png' width='100' height='100'><br><br>";
                                                }
                                                ?>
                    </span>
                </div>
            <?php } ?>
        </div>
    </div>
</div>