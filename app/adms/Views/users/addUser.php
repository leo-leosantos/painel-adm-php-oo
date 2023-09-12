

<?php

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
};
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

?>


<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Cadastrar usuario</span>
            <div class="top-list-right">
                <?php echo  "<a href='" . URLADM . "list-users/index/' class='btn-info' >Listar</a>"; ?>

            </div>
        </div>

        <div class="content-adm">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <span id="msg"></span>

        </div>



        <div class="content-adm">
        <form method="POST" action="" id="form-add-user" class="form-adm">
                <div class="row-input">

                    <div class="column">
                        <label class="title-input ">Nome<span class="text-danger">*</span> </label>
                        <input type="text" name="name" id="name" required value="<?php if (isset($valorForm['name'])) {
                                                                                        echo $valorForm['name'];
                                                                                    }    ?>" class="input-adm" placeholder="Nome completo">
                    </div>

                    <div class="column">
                        <label class="title-input">E-mail<span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" value="<?php if (isset($valorForm['email'])) {
                                                                                echo $valorForm['email'];
                                                                            }    ?>" required class="input-adm" placeholder="Melhor e-mail">
                    </div>

                </div>

                <div class="row-input">


                    <div class="column">

                        <label class="title-input">User</label>


                        <input type="text" class="input-adm" name="user" id="user" required placeholder="Digite o nome do usuario" value="<?php if (isset($valorForm['user'])) {
                                                                                                                                                echo $valorForm['user'];
                                                                                                                                            }    ?>">
                    </div>

                    <div class="column">

                        <label class="title-input">Senha<span class="text-danger">*</span></label>
                        <input type="password" name="password" required id="password" class="input-adm" placeholder="Digite a senha" onkeyup="passwordStrength()" autocomplete="on" value="<?php if (isset($valorForm['password'])) {
                                                                                                                                                                                                echo $valorForm['password'];
                                                                                                                                                                                            }    ?>">

                    </div>
                </div>



                <div class="row-input">

                    <div class="column">
                        <label class="title-input">Situacao<span class="text-danger">*</span></label>
                        <select name="adms_sits_user_id" id="adms_sits_user_id" class="input-adm">

                            <option value="">Selecione  </option>

                            <?php foreach ($this->data['select']['sit'] as $sit) {
                                extract($sit);
                                if ((isset($valorForm['adms_sits_user_id'])) and ($valorForm['adms_sits_user_id'] == $id_sit)) {
                                    echo " <option value='$id_sit' selected>$name_sit</option>";
                                } else {
                                    echo " <option value='$id_sit'>$name_sit</option>";
                                }
                            } ?>
                        </select>
                    </div>
                </div>


                <span id="msgViewStrength"></span><br>
                <button type="submit" name="SendAddNewUser"  class="btn btn-success" value="Cadastrar">Cadastrar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->
