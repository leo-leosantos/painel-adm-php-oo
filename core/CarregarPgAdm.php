<?php

namespace Core;



class CarregarPgAdm  extends Config
{
    private string $urlController;
    private string $urlMetodo;
    private string $urlParameter;
    private string $classLoad;
    private array $listPgPublic;
    private array $listPgPrivate;


    public function loadPage(?string $urlController, ?string $urlMetodo, ?string $urlParameter): void
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;

        //unset($_SESSION['user_id']);

        $this->pgPublic();
        if (class_exists($this->classLoad)) {
            $this->loadMetodo();
        } else {
            die("No class loaded. please Carregar PG ADM " . EMAILADMIN);
            // $this->urlController = $this->slugController(CONTROLLER);
            // $this->urlMetodo = $this->slugMetodo(METODO);
            // $this->urlParameter = "";
            // $this->loadPage($this->urlController ,$this->urlMetodo,  $this->urlParameter);
        }
    }

    private function loadMetodo(): void
    {
        $classLoad = new $this->classLoad();
        if (method_exists($classLoad, $this->urlMetodo)) {
            $classLoad->{$this->urlMetodo}();
        } else {
            die("Could not load class metodo not found" . EMAILADMIN);
        }
    }

    private function pgPublic(): void
    {
        $this->listPgPublic = ["Login", "Error", "Logout", "NewUser"];

        if (in_array($this->urlController, $this->listPgPublic)) {
            $this->classLoad = "\\App\\Adms\\Controllers\\" . $this->urlController;
        } else {
            $this->pgPrivate();
        }
    }

    private function pgPrivate(): void
    {
        $this->listPgPrivate = ["Dashboard", "Users"];

        if (in_array($this->urlController, $this->listPgPrivate)) {
            $this->verifyLogin();
        } else {
            $_SESSION['msg'] = "Error: Pagina não  encontrada";
            $urlRedirect =  URLADM . "login/index";
            header("Location: " . $urlRedirect);
        }
    }

    private function verifyLogin(): void
    {
        if ((isset($_SESSION['user_id'])) and (isset($_SESSION['user_name'])) and (isset($_SESSION['user_email']))) {
            $this->classLoad = "\\App\\Adms\\Controllers\\" . $this->urlController;
        } else {
            $_SESSION['msg'] = "Error: Para acessar a pagina faça login";
            $urlRedirect =  URLADM . "login/index";
            header("Location: " . $urlRedirect);
        }
    }
    private function slugController(string $slugController): string
    {

        $this->urlSlugController = $slugController;

        $this->urlSlugController =   strtolower($this->urlSlugController);
        $this->urlSlugController =   str_replace("-", " ", $this->urlSlugController);
        $this->urlSlugController =   ucwords($this->urlSlugController);
        $this->urlSlugController =   str_replace(" ", "", $this->urlSlugController);

        return $this->urlSlugController;
    }

    /**
     * Undocumented function
     *
     * @param [type] $urlSlugMetodo
     * @return string
     */
    private function slugMetodo(string $urlSlugMetodo): string
    {

        $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);
        $this->urlSlugMetodo =   lcfirst($this->urlSlugMetodo);
        return $this->urlSlugMetodo;
    }
}