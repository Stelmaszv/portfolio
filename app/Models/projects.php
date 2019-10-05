<?php
namespace AppModel;
use CoreMain\model;
use AppHelpel\showProjects;
use CoreMain\pagination;
use Corelanguage\language;
class projects extends model{
    function  Setings(){
        self::$table='projects';
    }
    function showProjects($place){
        $array=self::showAll();
        $data=array(
            'slide'  =>array(),
            'all'    =>array(),
        );
        foreach($array as $el){
            $el['description']=$el['eng'];
            if($el['slide']){
                array_push($data['slide'],$el);
            }
            array_push($data['all'],$el); 
        
        }
        return $data[$place];
    }
}   
