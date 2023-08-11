<?php
if(isset($this->data['form'])){

    $valorForm = $this->data['form'];
}
if(isset($this->data['form'][0])){

    $valorForm = $this->data['form'][0];
}

?>
<h1>Editar  Usuario</h1>

<?php if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>

<span id="msg"></span>
<form action="" method="post" id="form-add-user">

<label for="">Nome</label>
<input type="text" name="name" id="name" required placeholder="Digite o Nome completo" value="<?php if(isset($valorForm['name'])) {echo $valorForm['name'];}    ?>"><br><br>

<label for="">Email</label>
<input type="email" name="email" id="email" required placeholder="Digite o email" value="<?php if(isset($valorForm['email'])) 
{echo $valorForm['email'];}    ?>"><br><br>


<label for="">Apelidido</label>
<input type="text" name="nickname" id="nickname" required placeholder="Digite o nickname" value="<?php if(isset($valorForm['nickname'])) 
{echo $valorForm['nickname'];}    ?>"><br><br>


<label for="">User</label>
<input type="text" name="user" id="user" required placeholder="Digite o nome do usuario" value="<?php if(isset($valorForm['user'])) 
{echo $valorForm['user'];}    ?>"><br><br>


<span id="msgViewStrength"></span><br>
<button type="submit" name="SendAddNewUser" value="Cadastrar">Cadastrar</button>
</form>

<br><br>
<p><a href="<?= URLADM ?>login/index">Clique aqui</a>Para acessar</p>

