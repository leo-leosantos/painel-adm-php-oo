<?php
if(!empty($this->data['viewUser'][0]) ){
    
    extract($this->data['viewUser'][0]);


echo "<h1>Detalhes do Usuario</h1>";
echo "<a href='".URLADM."list-users/index/'>Listar</a></br>";
echo "<a href='".URLADM."edit-users/index/$id'>Editar</a></br>";
echo "<a href='".URLADM."edit-users-password/index/$id'>Editar Senha</a></br>";
echo "<a href='".URLADM."edit-users-image/index/$id'>Editar Image</a></br>";
echo "<a href='".URLADM."delete-users/index/$id' onclick='return confirm(\"Tem certeza que excluir?\")'>Apagar</a></br>"; 

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);

}


    "<br>";
    echo "id: $id <br>";
    echo "Email: $email <br>";
    echo "Nome: $name_usr <br>";   
    echo "Apelido: $nickname <br>";
    echo "Situação: <span style='color:$color'>$name_sit</span> <br>";
    if((!empty($image)) 
        and (file_exists("app/adms/assets/image/users/$id/$image")))
    {
            echo  "<img src='".URLADM."app/adms/assets/image/users/$id/$image' width='100' height='100'><br><br>";
    }else{
        echo  "<img src='".URLADM."app/adms/assets/image/users/user.png' width='100' height='100'><br><br>";
    }
    echo "Criado: ". date('d-m-Y H:i:s', strtotime($created))." <br>";

    if(!empty($modified)){
        echo "Editado: ". date('d-m-Y H:i:s', strtotime($modified))." <br>";

    }
    echo "<br>";

}
