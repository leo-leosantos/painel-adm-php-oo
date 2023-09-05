<?php
if (!defined('C8L6K7E')) {
    header("Location: http://localhost/admin/");
    die('not found');
}

if (isset($this->data['form'])) {

    $valorForm = $this->data['form'];
}
//criptograf a senha
//echo password_hash("123456",PASSWORD_DEFAULT);
?>

<div class="container-login">
    <div class="wrapper-login">

        <div class="title">
            <span>Área Restrita</span>
        </div>

        <div class="msg-alert">
                <?php if (isset($_SESSION['msg'])) {
                    echo "<span id='msg'>".$_SESSION['msg']."</span>";
                    unset($_SESSION['msg']);
                }else{
                  echo  "<span id='msg'></span>";
                } ?>

            </div>
        <form action="" method="post" id="form-login" class="form-login">
          
            <i class="fa-solid fa-user"></i>
            <input type="text" name="user" id="user" placeholder="Digite o Usuário" required value="<?php if (isset($valorForm['user'])) {
                                                                                                        echo $valorForm['user'];
                                                                                                    } ?>"><br><br>
    </div>

    <div class="row">
        <i class="fa-solid fa-lock"></i>
        <input type="password" name="password" id="password" required placeholder="Digite a senha" value="<?php if (isset($valorForm['password'])) {
                                                                                                                echo $valorForm['password'];
                                                                                                            }    ?>"><br><br>
    </div>

    <div class="row button">
        <button type="submit" name="SendLogin" value="Acessar">Acessar</button>
    </div>

    <div class="signup-link">
        <a href="<?= URLADM ?>new-user/index">Cadastrar</a> |
        <a href="<?= URLADM ?>recovery-password/index">Recuperar Senha ?</a>
    </div>
    </form>
</div>
</div>