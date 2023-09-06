<?php

namespace Core;

if(!defined('C8L6K7E')){
    header("Location: http://localhost/admin/");
    die('not found');
}

class CarregarPgAdm  extends Config
{
    private string $urlController;
    private string $urlMetodo;
    private ?string $urlParameter;
    private string $classLoad;
    private array $listPgPublic;
    private array $listPgPrivate;


    public function loadPage(?string $urlController, ?string $urlMetodo, ?string $urlParameter): void
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;


        $this->pgPublic();
        if (class_exists($this->classLoad)) {
            $this->loadMetodo();
        } else {
            die("No class loaded. please Carregar PG ADM " . EMAILADMIN);
       
        }
    }

    private function loadMetodo(): void
    {
        $classLoad = new $this->classLoad();
        if (method_exists($classLoad, $this->urlMetodo)) {
            $classLoad->{$this->urlMetodo}($this->urlParameter);
        } else {
            die("Could not load class metodo not found 46" . EMAILADMIN);
        }
    }

    private function pgPublic(): void
    {
        $this->listPgPublic = ["Login", "Error", "Logout", "NewUser", "ConfEmail",
        "NewConfEmail","RecoveryPassword","UpdatePassword"];

        if (in_array($this->urlController, $this->listPgPublic)) {
            $this->classLoad = "\\App\\Adms\\Controllers\\" . $this->urlController;
        } else {
            $this->pgPrivate();
        }
    }

    private function pgPrivate(): void
    {
        $this->listPgPrivate = ["Dashboard", "ListUsers","ViewUsers","AddUsers","EditUsers","EditUsersPassword",
            "EditUsersImage","DeleteUsers", "ViewProfile","EditProfile","EditProfilePassword","EditProfileImage","ListSitsUsers", "ViewSitsUsers", "AddSitsUsers", "EditSitsUsers", "DeleteSitsUsers",
            "AddColors","DeleteColors","EditColors","ListColors","ViewColors", "ListConfEmails", "ViewConfEmails", "AddConfEmails", "EditConfEmails", "EditConfEmailsPassword", "DeleteConfEmails"];

        if (in_array($this->urlController, $this->listPgPrivate)) {
            $this->verifyLogin();
        } else {
            $_SESSION['msg'] = "Error: Pagina não  encontrada pgprivate";
            $urlRedirect =  URLADM . "login/index";
            header("Location: " . $urlRedirect);
        }
    }

    private function verifyLogin(): void
    {
        if ((isset($_SESSION['user_id'])) and (isset($_SESSION['user_name'])) and (isset($_SESSION['user_email']))) {
            $this->classLoad = "\\App\\Adms\\Controllers\\" . $this->urlController;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Error: Para acessar a pagina faça login<p>";
            $urlRedirect =  URLADM . "login/index";
            header("Location: " . $urlRedirect);
        }
    }
    private function slugController(string $urlController): string
    {

        $this->urlController = $urlController;

        $this->urlController =   strtolower($this->urlController);
        $this->urlController =   str_replace("-", " ", $this->urlController);
        $this->urlController =   ucwords($this->urlController);
        $this->urlController =   str_replace(" ", "", $this->urlController);

        return $this->urlController;
    }

    /**
     * Undocumented function
     *
     * @param [type] $urlSlugMetodo
     * @return string
     */
    private function slugMetodo(string $urlMetodo): string
    {

        $this->urlMetodo = $this->slugController($urlMetodo);
        $this->urlMetodo =   lcfirst($this->urlMetodo);
        return $this->urlMetodo;
    }
}
