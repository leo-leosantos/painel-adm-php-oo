<?php
if(isset($this->data['form'])){

    $valorForm = $this->data['form'];
}
//criptograf a senha
//echo password_hash("123456",PASSWORD_DEFAULT);
?>
<span id="msg"></span>

<h1>Area Restrita</h1>

<?php if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
<form action="" method="post" id="form-login">

<label for="">Usuário</label>
<input type="text" name="user" id="user" placeholder="Digite o Usuário" value="<?php if(isset($valorForm['user'])) {echo $valorForm['user'];}    ?>"><br><br>
<label for="">Usuário</label>
<input type="password" name="password" id="password" placeholder="Digite a senha" value="<?php if(isset($valorForm['password'])) {echo $valorForm['password'];}    ?>"><br><br>

<button type="submit" name="SendLogin" value="Acessar">Acessar</button>
</form>

<br><br>
<p><a href="<?= URLADM ?>new-user/index">Cadastrar</a></p>

