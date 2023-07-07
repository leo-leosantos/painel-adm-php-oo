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
        define('CONTROLLERERRO','Login');
        define('EMAILADMIN','admin@admin.com');


        //banco de dados conexao usando o docker
        define('HOST','mysql-srv-7');
        define('USER','root');
        define('PASSWORD','root');
        define('DBNAME','celke_admin');
        define('PORT',3306);
       

    }
}