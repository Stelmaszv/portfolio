<?php
namespace AppControler;
use CoreMain\controller;
use AppModel\aboutme;
use AppModel\skill;
use Corelanguage\language;
class skills extends controller{
    function main() {
        $this->addElemnts();
    }
    function addElemnts(){
        $this->aboutme=new aboutme; 
        $this->templete->CAdd('[#aboutme#]',$this->aboutme->getData(language::getLang()));
        $this->skills=new skill;
        $this->templete->CLoop('backend',$this->skills->getSkills('backend'));
        $this->templete->CLoop('frontend',$this->skills->getSkills('frontend'));
        $this->templete->CLoop('others',$this->skills->getSkills('others'));
    }
}