<?php
if(isset($this->data['form'])){

    $valorForm = $this->data['form'];
}
if(isset($this->data['form'][0])){

    $valorForm = $this->data['form'][0];
}

?>
<h1>Editar Senha  Usuario</h1>

<?php 


if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>

<span id="msg"></span>
<form action="" method="post" id="form-edit-user-pass">

<input type="hidden" name="id" id="id"  value="<?php if(isset($valorForm['id'])) {echo $valorForm['id'];}    ?>"><br><br>
<label for="">Senha</label>
<input type="password" name="password"  id="password" required placeholder="Digite a senha"  onkeyup="passwordStrength()" autocomplete="on"  
value="<?php if(isset($valorForm['password'])) {echo $valorForm['password'];}    ?>"><br><br>

<span id="msgViewStrength"></span><br>

<button type="submit" name="SendEditUserPass" value="Editar">EDITAR Senha</button>
</form>

<br><br>

