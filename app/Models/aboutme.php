<?php
namespace AppModel;
use CoreMain\model;
class aboutme extends model{
    function  Setings(){
        self::$table='aboutme';
    }
    function getData($field){
        $array= self::faind(1);
        return $array[$field];
    }
}   