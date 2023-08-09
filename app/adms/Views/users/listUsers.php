<?php


echo "<h2>List User</h2>";


if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);

}

foreach($this->data['listUsers'] as $user){
        extract($user);
    echo "ID: " . $id. "<br>";
    echo "Name: " . $name. "<br>";
    echo "Email: " . $email. "<br><hr>";
  

}