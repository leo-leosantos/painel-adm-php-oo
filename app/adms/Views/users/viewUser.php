<?php

echo "<h1>Detalhes do Usuario</h1>";

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);

}
if(!empty($this->data['viewUser'][0]) ){
    extract($this->data['viewUser'][0]);

    echo "id: $id <br>";
    echo "Email: $email <br>";
    echo "Nome: $name <br>";   
    echo "Apelido: $nickname <br>";
    echo "image: $image <br>";
    echo "Criado: ". date('d-m-Y H:i:s', strtotime($created))." <br>";

    if(!empty($modified)){
        echo "Editado: ". date('d-m-Y H:i:s', strtotime($modified))." <br>";

    }
    echo "<br>";

}
