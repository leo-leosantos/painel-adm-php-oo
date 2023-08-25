<?php
if(isset($this->data['form'])){

    $valorForm = $this->data['form'];
}
if(isset($this->data['form'][0])){

    $valorForm = $this->data['form'][0];
}
echo "<a href='".URLADM."view-profile/index'>Perfil</a><br>";

?>
<h1>Editar Senha  Perfil</h1>

<?php 


if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>

<span id="msg"></span>
<form action="" method="post" id="form-edit-prof-pass">

<label for="">Senha Perfil</label>
<input type="password" name="password"  id="password" required  placeholder="Digite a senha"  onkeyup="passwordStrength()" autocomplete="on"  
value="<?php if(isset($valorForm['password'])) {echo $valorForm['password'];}    ?>"><br><br>

<span id="msgViewStrength"></span><br>

<button type="submit" name="SendEditProfPass" value="Editar">EDITAR Senha Perfil</button>
</form>

<br><br>

