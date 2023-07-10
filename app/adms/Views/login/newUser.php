<?php
if(isset($this->data['form'])){

    $valorForm = $this->data['form'];
}

?>
<h1>Novo Usuario</h1>

<?php if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>

<span id="msg"></span>
<form action="" method="post" id="form-new-user">

<label for="">Nome</label>
<input type="text" name="name" id="name" placeholder="Digite o Nome completo" value="<?php if(isset($valorForm['name'])) {echo $valorForm['name'];}    ?>"><br><br>

<label for="">Email</label>
<input type="email" name="email" id="email" placeholder="Digite o email" value="<?php if(isset($valorForm['email'])) {echo $valorForm['email'];}    ?>"><br><br>


<label for="">senha</label>
<input type="password" name="password" id="password" placeholder="Digite a senha" value="<?php if(isset($valorForm['password'])) {echo $valorForm['password'];}    ?>"><br><br>

<button type="submit" name="SendNewUser" value="Cadastrar">Cadastrar</button>
</form>

<br><br>
<p><a href="<?= URLADM ?>login/index">Clique aqui</a>Para acessar</p>

