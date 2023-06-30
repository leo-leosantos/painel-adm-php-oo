<?php

namespace Core;

use App\Adms\Controllers\LoginController;
use App\Adms\Controllers\UsersController;



class ConfigController  extends Config
{
    private string $url;
    private array $urlArray;
    private string $urlController;
    private string $urlMetodo;
    private string $urlParamenter;
    private string $classLoad;
    private string $urlSlugController;
    private string $urlSlugMetodo;

    private array $format;


    public function __construct()
    {
        $this->configAdm();

        if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)))
        {
             $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

             $this->clearUrl();
             $this->urlArray = explode("/", $this->url);

                if(isset($this->urlArray[0])){
                    $this->urlController = $this->slugController($this->urlArray[0]);
                }else{
                    $this->urlController = $this->slugController(CONTROLLER);
                }

                if(isset($this->urlArray[1])){
                    $this->urlMetodo =$this->slugMetodo($this->urlArray[1]);  
                }else{
                    $this->urlMetodo = $this->slugMetodo(METODO);
                }

                if(isset($this->urlArray[2])){
                    $this->urlParamenter = $this->urlArray[2];
                }else{
                    $this->urlParamenter = "";
                }
        }else{
            $this->urlController = $this->slugController(CONTROLLERERRO);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParamenter = "";

        }
        echo "COntroller: {$this->urlController}<br> ";
        echo "metohod: {$this->urlMetodo}<br> ";
        echo "paramenter: {$this->urlParamenter}<br> ";

    }

    private function clearUrl(): void
    {
            //eliminar as tags <p><a href>
             $this->url =   strip_tags($this->url);
             //elimnar os espaços  em branco
             $this->url =   trim($this->url);
             //elimnar a barra no final
             $this->url =   rtrim($this->url, "/");
               //Elminar caracteos
            $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
             $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
            $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']);

    }

    private function slugController($slugController): string
    {   

            $this->urlSlugController = $slugController;

            $this->urlSlugController =   strtolower($this->urlSlugController);
            $this->urlSlugController =   str_replace("-", " ",$this->urlSlugController);
            $this->urlSlugController =   ucwords($this->urlSlugController);
            $this->urlSlugController =   str_replace(" ", "",$this->urlSlugController);

             return $this->urlSlugController;
    }

    private function slugMetodo($urlSlugMetodo): string
    {   

            $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);
            $this->urlSlugMetodo =   lcfirst($this->urlSlugMetodo);
            return $this->urlSlugMetodo;
    }


    public function loadPage(): void
    {


        //  $this->urlController = ucwords($this->urlController);
        // $this->classLoad = "\\App\\Adms\Controllers\\" . $this->urlController;

        //   $classPage = new $this->classLoad();
        //   $classPage->{$this->urlMetodo}();
        // $login =  new LoginController();
        // $login->index();


        // $users =  new UsersController();
        // $users->index();
    }

 
}