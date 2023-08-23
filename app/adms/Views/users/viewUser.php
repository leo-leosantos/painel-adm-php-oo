<?php
if(!empty($this->data['viewUser'][0]) ){
    
    extract($this->data['viewUser'][0]);


echo "<h1>Detalhes do Usuario</h1>";
echo "<a href='".URLADM."list-users/index/'>Listar</a></br>";
echo "<a href='".URLADM."edit-users/index/$id'>Editar</a></br>";
echo "<a href='".URLADM."edit-users-password/index/$id'>Editar Senha</a></br>";
echo "<a href='".URLADM."edit-users-image/index/$id'>Editar Image</a></br>";
echo "<a href='".URLADM."delete-users/index/$id'>Apagar</a></br>";

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);

}


    "<br>";
    echo "id: $id <br>";
    echo "Email: $email <br>";
    echo "Nome: $name_usr <br>";   
    echo "Apelido: $nickname <br>";
    echo "image: $image <br>";
    echo "Situação: <span style='color:$color'>$name_sit</span> <br>";

    echo "Criado: ". date('d-m-Y H:i:s', strtotime($created))." <br>";

    if(!empty($modified)){
        echo "Editado: ". date('d-m-Y H:i:s', strtotime($modified))." <br>";

    }
    echo "<br>";

}
