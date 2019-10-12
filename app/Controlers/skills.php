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
        $this->templete->CLoop('backend',arraysort($this->skills->getSkills('backend'),'procent'));
        $this->templete->CLoop('frontend',arraysort($this->skills->getSkills('frontend'),'procent'));
        $this->templete->CLoop('others',arraysort($this->skills->getSkills('others'),'procent'));
        $this->templete->CAdd('[#about#]',language['translate']['about']);
        
    }
}