<?php
echo "<h1>Detalhes do Perfil</h1>";
// echo "<a href='".URLADM."edit-users-password/index/$id'>Editar Senha</a></br>";
// echo "<a href='".URLADM."edit-users-image/index/$id'>Editar Image</a></br>";
// echo "<a href='".URLADM."delete-users/index/$id'>Apagar</a></br>";

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
}


if(!empty($this->data['viewProfile'][0]) ){
    extract($this->data['viewProfile'][0]);
    
    echo "<a href='". URLADM. "edit-profile/index'>Editar Perfil</a></br>";


    if((!empty($image)) 
        and (file_exists("app/adms/assets/image/users/"  . $_SESSION['user_id'] . "/$image")))
    {
            echo  "<img src='".URLADM."app/adms/assets/image/users/"
            .$_SESSION['user_id'] . "/$image' width='100' height='100'><br><br>";
    }else{
        echo  "<img src='".URLADM."app/adms/assets/image/users/user.png' width='100' height='100'><br><br>";
    }


    echo "Email: $email <br>";
    echo "Nome: $name <br>";   
    echo "Apelido: $nickname <br>";

    echo "Criado: ". date('d-m-Y H:i:s', strtotime($created))." <br>";

  

}
