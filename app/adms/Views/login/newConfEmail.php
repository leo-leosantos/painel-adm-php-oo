<?php
// if(isset($this->data['form'])){

//     $valorForm = $this->data['form'];
// }

?>
<!-- <?php if(isset($valorForm['email'])) {echo $valorForm['email'];}    ?> -->

<h1>Novo Link</h1>

<?php if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>

<span id="msg"></span>
<form action="" method="post" id="form-new-conf-email">


<label for="">Email</label>
<input type="email" name="email" id="email" required placeholder="Digite o email" value="<?php if(isset($valorForm['email'])) {echo $valorForm['email'];}    ?>"><br><br>



<button type="submit" name="SendNewConfEmail" value="Recuperar">Recuperar o link</button>
</form>

<br><br>
<p><a href="<?= URLADM ?>login/index">Clique aqui</a>Para acessar</p>

