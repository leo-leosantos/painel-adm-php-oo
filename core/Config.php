<?php


namespace Core;

abstract class Config
{
    protected function configAdm()
    {
        define('URL','http://localhost/site');
        define('URLADM','http://localhost/admin/');
        define('CONTROLLER','Login');
        define('METODO','index');
        define('CONTROLLERERRO','Erro');
        define('EMAILADMIN','admin@admin.com');

    }
}