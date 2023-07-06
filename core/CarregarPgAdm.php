<?php

namespace Core;



class CarregarPgAdm  extends Config
{
    private string $urlController;
    private string $urlMetodo;
    private string $urlParameter;
    private string $classLoad;


    public function loadPage(?string $urlController, ?string $urlMetodo, ?string $urlParameter)
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;


        var_dump([ $this->urlController, $this->urlMetodo ,$this->urlParameter]);

        $this->classLoad = "\\App\\Adms\\Controllers\\" . $this->urlController;
        if(class_exists($this->classLoad)){
            
        }

    }
}
