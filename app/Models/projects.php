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
    function showProjects($limit){
        $this->pagination=new pagination($limit);
        $this->pagination->setSql('SELECT * FROM `projects`');
        foreach($this->pagination->loop as $el=>$value){
            $this->pagination->loop[$el]['discripttion']=$this->pagination->loop[$el][language::getLang()];
        }
        return $this->pagination->loop;
    }
}   
