<?php

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
echo "<h2>List User</h2>";

echo "<a href='".URLADM."add-users/index/'>Cadastrar</a></br>";
echo "<br>";
echo "<hr>";

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);

}

foreach($this->data['listUsers'] as $user){
        extract($user);
    echo "ID: " . $id. "<br>";
    echo "Name: " . $name_usr. "<br>";
    echo "Email: " . $email. "<br>";
    echo "Situação:  <span style='color: $color'>$name_sit</span><br>";


    echo "<a href='".URLADM."view-users/index/$id'>Visualizar</a></br>";
    echo "<a href='".URLADM."edit-users/index/$id'>Editar</a></br>";    
    echo "<a href='".URLADM."delete-users/index/$id' onclick='return confirm(\"Tem certeza que excluir?\")'>Apagar</a></br>"; 
    // ?>

    // <a href="<?= URLADM.'delete-users/index/'.$id; ?>" onclick="return confirm('Excluir tem certeza ?')" >Apagar</a><br>
    // <?php
    echo "<hr>";

}

echo $this->data['pagination'];
