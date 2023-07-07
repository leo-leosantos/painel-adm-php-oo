<?php


namespace App\Adms\Controllers;


class Logout
{

    /**
     * destruir as sessoes do usuario logado
     */

    public function index(): void
    {
        unset($_SESSION['user_id'],
            $_SESSION['user_name'],
            $_SESSION['user_nickname'],$_SESSION['user_email'],$_SESSION['user_image']);

            $_SESSION['msg'] = "Logout redirecit com sucess";
            $urlRedirect =  URLADM . "login/index";
            header("Location: " . $urlRedirect);
      
    }
}
