<?php
namespace AppModel;
use CoreMain\model;
class skill extends model{
    function  Setings(){
        self::$table='skills';
    }
    function getSkills($place){
        $array=self::showAll();
        $data=array(
            'backend'  =>array(),
            'frontend' =>array(),
            'others'   =>array()
        );
        foreach($array as $skill){
            array_push($data[$skill['type']],$skill);
        }
        return $data[$place];
    }
}  