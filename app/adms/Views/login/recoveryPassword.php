<?php
if(!defined('C8L6K7E')){
    header("Location: http://localhost/admin/");
    die('not found');
}
?>
<!-- <?php if(isset($valorForm['email'])) {echo $valorForm['email'];}    ?> -->

<h1>REcupera Senha</h1>

<?php if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>

<span id="msg"></span>
<form action="" method="post" id="form-recovery-pass">


<label for="">Email</label>
<input type="email" name="email" id="email" required placeholder="Digite o email" value="<?php if(isset($valorForm['email'])) {echo $valorForm['email'];}    ?>"><br><br>



<button type="submit" name="SendRecoverPass" value="Recuperar">Recuperar Senha</button>
</form>

<br><br>
<p><a href="<?= URLADM ?>login/index">Clique aqui</a>Para acessar</p>

