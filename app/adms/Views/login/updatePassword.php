<?php

if(!defined('C8L6K7E')){
    header("Location: http://localhost/admin/");
    die('not found');
}

if(isset($this->data['form'])){

    $valorForm = $this->data['form'];
}
//criptograf a senha
//echo password_hash("123456",PASSWORD_DEFAULT);
?>
<span id="msg"></span>

<h1>Nova Senha</h1>

<?php if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
<form action="" method="post" id="update-password">

<label for="">Usuário</label>
<input type="password" name="password" id="password" onkeyup="passwordStrength()" required autocomplete="on" placeholder="Digite a nova senha" value="<?php if(isset($valorForm['password'])) {echo $valorForm['password'];}    ?>"><br><br>

<button type="submit" name="SendUpPass" value="Salvar">Salvar</button>
</form>

<br><br>
<p><a href="<?= URLADM ?>login/index">Clique aqui</a>Para acessar</p>

