<?php
if(isset($this->data['form'])){

    $valorForm = $this->data['form'];
}

?>
<h1>Cadastrar Novo Usuario</h1>

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

<label for="">User</label>
<input type="text" name="user" id="user" required placeholder="Digite o nome do usuario" value="<?php if(isset($valorForm['user'])) 
{echo $valorForm['user'];}    ?>"><br><br>



<label for="">Situação</label>
<select name="adms_sits_user_id" id="adms_sits_user_id">
    <option value="">Selecione</option>
        <?php foreach ($this->data['select']['sit'] as $sit) {
                extract($sit);
                if((isset($valorForm['adms_sits_user_id'])) and ($valorForm['adms_sits_user_id'] == $id_sit)){
                    echo " <option value='$id_sit' selected>$name_sit</option>";
                }else{
                    echo " <option value='$id_sit'>$name_sit</option>";

                }
              
        } ?>

</select><br><br>
<label for="">senha</label>
<input type="password" name="password" required id="password" placeholder="Digite a senha" onkeyup="passwordStrength()" autocomplete="on" value="<?php if(isset($valorForm['password'])) {echo $valorForm['password'];}    ?>"><br><br>

<span id="msgViewStrength"></span><br>
<button type="submit" name="SendAddNewUser" value="Cadastrar">Cadastrar</button>
</form>



