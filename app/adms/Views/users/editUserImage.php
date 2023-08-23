<?php
if(isset($this->data['form'])){

    $valorForm = $this->data['form'];
}
if(isset($this->data['form'][0])){

    $valorForm = $this->data['form'][0];
}

?>
<h1>Editar  Image</h1>

<?php 


if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>

<span id="msg"></span>
<form action="" method="post" id="form-add-user" enctype="multipart/form-data">

<input type="hidden" name="id" id="id"  value="<?php if(isset($valorForm['id'])) {echo $valorForm['id'];}    ?>"><br><br>
<label for="">Image 300x300</label>
<input type="file" name="new_image" id="image"><br><br>




<span id="msgViewStrength"></span><br>
<button type="submit" name="SendEditUserImage" value="Editar">SALVAR</button>
</form>

<br><br>

